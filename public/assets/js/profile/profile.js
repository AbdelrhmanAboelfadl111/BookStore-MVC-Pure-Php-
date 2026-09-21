$(document).ready(function () {
  let type = window.location.search
    .replace("?", "")
    .split("&")[0]
    .split("=")[0];

  if (type) {
    $(`#${type}-tab`).click();
  }
});

let paginationTabs = {
  "home-page": { pane: "home-tab-pane", tab: "home-tab" },
  "Customers-page": { pane: "Customers-tab-pane", tab: "Customers-tab" },
  "Authors-page": { pane: "Authors-tab-pane", tab: "Authors-tab" },
  "Books-page": { pane: "Books-tab-pane", tab: "Books-tab" },
  "Ordered-page": { pane: "Ordered-tab-pane", tab: "Ordered-tab" },
  "Canceled-page": { pane: "Canceled-tab-pane", tab: "Canceled-tab" },
  "Done-page": { pane: "Done-tab-pane", tab: "Done-tab" },
};

$(document).on("click", ".pagination a:not(.pagination-link)", function (e) {
  e.preventDefault();

  let link = new URL(this.href, window.location.href);
  let pageType = Object.keys(paginationTabs).find((key) =>
    link.searchParams.has(key),
  );
  let paginationTarget = paginationTabs[pageType];
  let targetId = paginationTarget?.pane;

  if (!targetId || $(this).closest(".disabled").length) {
    return;
  }

  let target = document.getElementById(targetId);
  if (!target) {
    return;
  }

  target.classList.add("opacity-50");

  fetch(link.href, {
    headers: { "X-Requested-With": "XMLHttpRequest" },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Unable to load this page");
      }
      return response.text();
    })
    .then((html) => {
      let page = new DOMParser().parseFromString(html, "text/html");
      let updatedTarget = page.getElementById(targetId);

      if (!updatedTarget) {
        throw new Error("Pagination response is missing the target tab");
      }

      target.innerHTML = updatedTarget.innerHTML;
      window.history.pushState({}, "", link.href);
      $(`#${paginationTarget.tab}`).click();
    })
    .catch((error) => {
      console.error(error);
      isError("error", "Unable to load this page");
    })
    .finally(() => {
      target.classList.remove("opacity-50");
    });
});

function isError(type, msg) {
  Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    },
  }).fire({
    icon: type,
    title: msg,
  });
}

function imgPath(imgName) {
  return window.location.origin + "/BookStore/public/assets/imgs/" + imgName;
}

$("#AuthorForm").submit(function (e) {
  e.preventDefault();

  let dataForm = new FormData(this);
  $.ajax({
    type: "post",
    url: "profile/AddAuthor",
    data: dataForm,
    success: function (response) {
      console.log(response);
      $("#AuthorForm").get(0).reset();
      $(`#AuthorForm p.alert[data-error-name]`).addClass("d-none");
      $("#staticBackdrop6 .btn-close").click();

      $("#authors").prepend(`
                    <div class='col-lg-6 column'>
                        <div class='infoBox h-100'>
                            <div class='imgCon'>
                                <img src='${imgPath("page1.png")}'>
                            </div>
                            <div class='nameCon mb-3'>
                                <h3>${response.data.name}</h3>
                            </div>
                            <div class='infoCon mb-2'>
                                <div class='Bio mb-2'>
                                    <h3 class='lable fw-bold'>BIO :</h3>
                                    <h3 class='info w-80'> ${response.data.bio.substr(0, 100)} ... </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
    },
    error: function (response) {
      let errors = response.responseJSON.data;
      showErrors(errors);
    },
  });
});

function showErrors(errors) {
  for (let error in errors) {
    $(`p.alert[data-error-name="${error}"]`)
      .text(errors[error].join(" "))
      .removeClass("d-none");
  }
}

$(document).on("click", "#filterBooksButton", function (e) {
  e.preventDefault();
  $("#filterBook").trigger("submit");
});

$("#filterBook").on("submit", function (e) {
  e.preventDefault();
  let dataForm = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "/BookStore/public/profile/filterBooks",
    data: dataForm,
    dataType: "json",
    success: function (response) {
      console.log(response);
      let books = response.data.data;
      let currentPage = response.data.current_page;
      let total = response.data.total;
      $("#books").html("");
      $("#Books-tab-pane nav").remove();
      if (books.length != 0) {
        for (let i = 0; i < books.length; i++) {
          $("#books").append(`
                                <div class='col-lg-6 column'>
                            <div class='infoBox h-100'>
                                <div class='imgCon'>
                                    <img src='${imgPath(
                                      books[i].image == null
                                        ? "book.png"
                                        : `uploads/${books[i].image}`,
                                    )}'>
                                </div>
                                <div class='nameCon mb-3'>
                                    <h3>${books[i]["title"]}</h3>
                                </div>
                                <div class='infoCon mb-2'>
                                    <div class='mail mb-2'>
                                        <h3 class='lable fw-bold'>Author :</h3>
                                        <h3 class='info'> ${books[i]["author_name"]}</h3>
                                    </div>
                                    <div class='gender mb-2'>
                                        <h3 class='lable fw-bold'>Price :</h3>
                                        <h3 class='info '>  ${books[i]["price"]}</h3>
                                    </div>
                                    <div class='gender mb-2'>
                                        <h3 class='lable fw-bold'>Stock :</h3>
                                        <h3 class='info '> ${books[i]["stock"]}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            `);
        }
        $("#Books-tab-pane").append(preparePagination(response.data));
        $("#Books-tab-pane nav");
      } else {
        $("#books").append("<p class= 'alert alert-danger'>No books</p>");
      }
    },
    error: function (response) {
      console.error(
        "Filter request failed:",
        response.status,
        response.responseText,
      );
      isError("error", "Filter request failed");
    },
  });
})



function preparePagination(books) {
  if (!books.data || books.data.length === 0) {
    return "";
  }

  let perPage = 10;

  let pagesNumber = Math.ceil(books.total / perPage);

  let currentPage = Number(books.current_page);

  let nextPageNumber =
    currentPage < pagesNumber ? currentPage + 1 : pagesNumber;

  let prevPageNumber = currentPage > 1 ? currentPage - 1 : 1;

  let isNextPageDisabled = currentPage >= pagesNumber ? "disabled" : "";

  let isPrevPageDisabled = currentPage <= 1 ? "disabled" : "";

  let prepareLi = "";

  // Previous
  prepareLi += `
    <li class="page-item ${isPrevPageDisabled}">
        <a
            class="page-link pagination-link"
            href="#"
            data-page="${prevPageNumber}"
        >
            Previous
        </a>
    </li>
`;

  // Numbers
  for (let i = 1; i <= pagesNumber; i++) {
    let isActive = currentPage === i ? "active" : "";

    prepareLi += `
        <li class="page-item">
            <a
                class="page-link pagination-link ${isActive}"
                href="#"
                data-page="${i}"
            >
                ${i}
            </a>
        </li>
    `;
  }

  // Next
  prepareLi += `
    <li class="page-item ${isNextPageDisabled}">
        <a
            class="page-link pagination-link"
            href="#"
            data-page="${nextPageNumber}"
        >
            Next
        </a>
    </li>
`;

  return `
    <nav aria-label="Page navigation">
        <ul class="pagination">
            ${prepareLi}
        </ul>
    </nav>
`;
}

$(document).on("click", ".pagination-link", function (e) {
  e.preventDefault();

  let page = $(this).data("page");

  let dataForm = new FormData($("#filterBook")[0]);

  dataForm.append("CurrentPage", page);

  $.ajax({
    type: "POST",
    url: "/BookStore/public/profile/filterBooks",
    data: dataForm,
    processData: false,
    contentType: false,

    success: function (response) {
      console.log(response);

      let books = response.data.data;

      $("#books").html("");

      $("#Books-tab-pane nav").remove();

      if (books.length !== 0) {
        for (let i = 0; i < books.length; i++) {
          $("#books").append(`
                    <div class="col-lg-6 column">

                        <div class="infoBox h-100">

                            <div class="imgCon">
                                <img src='${imgPath(
                                  books[i].image == null
                                    ? "book.png"
                                    : `uploads/book.png`,
                                )}'>
                            </div>

                            <div class="nameCon mb-3">
                                <h3>${books[i].title}</h3>
                            </div>

                            <div class="infoCon mb-2">

                                <div class="mail mb-2">
                                    <h3 class="lable fw-bold">
                                        Author :
                                    </h3>

                                    <h3 class="info">
                                        ${books[i].author_name}
                                    </h3>
                                </div>

                                <div class="gender mb-2">
                                    <h3 class="lable fw-bold">
                                        Price :
                                    </h3>

                                    <h3 class="info">
                                        ${books[i].price}
                                    </h3>
                                </div>

                                <div class="gender mb-2">
                                    <h3 class="lable fw-bold">
                                        Stock :
                                    </h3>

                                    <h3 class="info">
                                        ${books[i].stock}
                                    </h3>
                                </div>

                            </div>

                        </div>

                    </div>
                `);
        }

        $("#Books-tab-pane").append(preparePagination(response.data));
      } else {
        $("#books").append(`
                <p class="alert alert-danger">
                    No books
                </p>
            `);
      }
    },

    error: function (response) {
      console.log(response);
    },
  });
});

function openAddBook(authorId, authorName) {
  $("#AuthorIdInput").val(authorId);

  $("#exampleInputName").val(authorId).find("option:selected").text(authorName);

  let modalElement = document.getElementById("staticBackdrop7");

  let modal = bootstrap.Modal.getOrCreateInstance(modalElement);

  modal.show();
}

$("#addBook").submit(function (e) {
  $("#addBook p.alert[data-error-name]").addClass("d-none").text("");
  let dataForm = new FormData(this);
  e.preventDefault();
  $.ajax({
    type: "post",
    url: "profile/addBook",
    data: dataForm,
    success: function (response) {
      console.log(response);
      let book = response.data;
      $("#addBook").get(0).reset();
      $(`#addBook p.alert[data-error-name]`).addClass("d-none");
      let modalElement = document.getElementById("staticBackdrop7");

      let modal = bootstrap.Modal.getOrCreateInstance(modalElement);
      modal.hide();
      $("#books").prepend(`
                                <div class='col-lg-6 column'>
                            <div class='infoBox h-100'>
                                <div class='imgCon'>
                                    <img src='${imgPath(
                                      book.image == null
                                        ? "book.png"
                                        : `uploads/book.png`,
                                    )}'>
                                </div>
                                <div class='nameCon mb-3'>
                                    <h3>${book["title"]}</h3>
                                </div>
                                <div class='infoCon mb-2'>
                                    <div class='mail mb-2'>
                                        <h3 class='lable fw-bold'>Author :</h3>
                                        <h3 class='info'> ${book["author_name"]}</h3>
                                    </div>
                                    <div class='gender mb-2'>
                                        <h3 class='lable fw-bold'>Price :</h3>
                                        <h3 class='info '>  ${book["price"]}</h3>
                                    </div>
                                    <div class='gender mb-2'>
                                        <h3 class='lable fw-bold'>Stock :</h3>
                                        <h3 class='info '> ${book["stock"]}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            `);
    },
    error: function (response) {
      let errors = response.responseJSON.data;
      showErrors(errors);
    },
  });
});

function banUser(userId, text, event) {
  event?.preventDefault();
  event?.stopPropagation();

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: `Yes, ${text} it!`,
  }).then((result) => {
    if (result.isConfirmed) {
      let dataForm = {
        userId: userId,
      };
      $.ajax({
        type: "post",
        url: "/BookStore/public/profile/banUser",
        data: dataForm,
        success: function (response) {
          Swal.fire({
            icon: "success",
            title: `${text === "Ban" ? "Banned" : "Unbanned"} successfully`,
            showConfirmButton: false,
            timer: 900,
            timerProgressBar: true,
          });
        },
        error: function (response) {
          Swal.fire({
            icon: "error",
            title: "Something went wrong",
            text:
              response.status === 403
                ? "Only administrators can ban users."
                : "The user was not banned.",
          });
        },
      });

      //     Swal.fire({
      //     title: "Deleted!",
      //     text: "Your file has been deleted.",
      //     icon: "success",
      // });
    }
  });
}

function addToCart(bookId, that) {
  let quantityInput = $(that).next(),
    quantity = Number(quantityInput.val());

  if (quantity == 0) {
    return;
  }

  let dataForm = {
    bookId: bookId,
    quantityBooks: quantity,
  };

  $.ajax({
    type: "post",
    url: "profile/AddToCart",
    data: dataForm,
    success: function (response) {
      quantityInput.val("");

      let totalItems = response.data.totalItems;

      $("#countOfOrders").text(totalItems);
    },
    error: function (response) {
      let errors = response.responseJSON.data;
      showErrors(errors);
    },
  });
  console.log(bookId, that);
}

function getItemsIntoCart(orderId = null, status = "cart") {
  let formData = {};

  if (orderId !== null) {
    formData.orderId = orderId;
  }

  $.ajax({
    type: "post",
    url: "profile/getItemsIntoCart",
    data: formData,

    success: function (response) {
      console.log("FULL RESPONSE:", response);

      let books = response.data;

      if (!books || books.length === 0) {
        $("#staticBackdrop8 .modal-body").html(`
                    <div class="alert alert-warning text-center">
                        There is no data in the cart.
                    </div>
                `);

        let modal = bootstrap.Modal.getOrCreateInstance(
          document.getElementById("staticBackdrop8"),
        );

        modal.show();

        return;
      }

      let modalBody = $("#staticBackdrop8 .modal-body");

      modalBody.html(`
                <h5>
                    Total :
                    <span class="text-success" id="totalPrice">
                        ${books[0].total_price}
                    </span>
                </h5>

                <div class="row"></div>

                ${
                  status == "cart"
                    ? `
                            <button
                                class="btn btn-success m-auto"
                                onclick="fireOrder(${books[0].order_id})">
                                Order Now
                            </button>
                        `
                    : ""
                }
            `);

      for (let book of books) {
        modalBody.find(".row").append(bookComponent(book, status));
      }

      let modal = bootstrap.Modal.getOrCreateInstance(
        document.getElementById("staticBackdrop8"),
      );

      modal.show();
    },

    error: function (response) {
      console.log("ERROR:", response);

      let errors = response.responseJSON?.data;

      if (errors) {
        showErrors(errors);
      }
    },
  });
}

function bookComponent(book, status) {
  let additionalRows = "";

  if (status == "books") {
    additionalRows = `
            <div class='gender mb-2 d-flex'>
                <h4 class='lable fw-bold'>Stock :</h4>
                <h4 class='info'>${book["stock"]}</h4>
            </div>
        `;

    if (userRole == "customer") {
      additionalRows += `
                <div class="input-group mb-3">
                    <button
                        class="btn btn-outline-success"
                        type="button"
                        onclick="addToCart(${book["book_id"]}, this)">
                        Add To Cart
                    </button>

                    <input
                        type="number"
                        class="form-control text-center"
                        placeholder="Quantity"
                        min="1"
                        id="input-quantity-${book["book_id"]}">
                </div>
            `;
    }
  } else if (status == "cart") {
    additionalRows = `
            <div class='gender mb-2 d-flex'>
                <h4 class='lable fw-bold'>Subtotal :</h4>
                <h4 class='info subTotal'>${book["subtotal"]}</h4>
            </div>

            <div class="input-group mb-3">
                <button
                    class="btn btn-outline-danger"
                    type="button"
                    onclick="decreaseOrderItem(${book["order_item_id"]}, this)">
                    -
                </button>

                <input
                    type="number"
                    class="form-control text-center"
                    value="${book["quantity"]}"
                    disabled>

                <button
                    class="btn btn-outline-success"
                    type="button"
                    onclick="increaseOrderItem(${book["order_item_id"]}, this)">
                    +
                </button>
            </div>

            <div
                class="btn btn-danger w-50 m-auto"
                onclick="deleteOrderItem(${book["order_item_id"]}, this)">
                Remove
            </div>
        `;
  }

  return `
        <div class='col-lg-6 column'>
            <div class='infoBox h-100' data-book-id="${book["book_id"]}">

                <div class='imgCon'>
                    <img src='${imgPath(
                      book.image == null ? "book.png" : `uploads/${book.image}`,
                    )}'>
                </div>

                <div class='nameCon mb-3'>
                    <h4>${book["title"]}</h4>
                </div>

                <div class='infoCon mb-2 d-flex flex-column justify-content-center'>

                    <div class='mail mb-2 d-flex'>
                        <h6 class='lable fw-bold'>Author :</h6>
                        <h6 class='info'>${book["authors_name"]}</h6>
                    </div>

                    <div class='gender mb-2 d-flex'>
                        <h6 class='lable fw-bold'>Price :</h6>
                        <h6 class='info'>${book["price"]}</h6>
                    </div>

                     <div class='gender mb-2 d-flex'>
                        <h6 class='lable fw-bold'>quantity :</h6>
                        <h6 class='info'>${book["quantity"]}</h6>
                    </div>

                    ${
                      book["cancel_reason"]
                        ? `<div class='gender mb-2 d-flex'>
                        <h6 class='lable fw-bold'>Cancel Reason :</h6>
                        <h6 class='info'>${book["cancel_reason"]}</h6>
                    </div>`
                        : ""
                    }

                    ${additionalRows}

                </div>
            </div>
        </div>
    `;
}

function increaseOrderItem(orderItem, btn) {
  let cartELM = $(btn).parents(".infoBox"),
    buttons = cartELM.find("button");

  buttons.prop("disabled", true);

  let dataForm = {
    orderItemId: orderItem,
  };
  $.ajax({
    type: "post",
    url: "profile/increaseOrderItem",
    data: dataForm,
    success: function (response) {
      let bookId = response.data.orderItem.book_id;

      $(`.infoBox[data-book-id = "${bookId}"] h4.subTotal`).text(
        response.data.orderItem.subtotal,
      );

      $(`.infoBox[data-book-id = "${bookId}"] input`).val(
        response.data.orderItem.quantity,
      );

      $(`#totalPrice`).text(response.data.totalPrice);

      buttons.prop("disabled", false);
    },
    error: function (response) {
      let errors = response.responseJSON.data;
      showErrors(errors);
    },
  });
}

function decreaseOrderItem(orderItem, btn) {
  let cartELM = $(btn).parents(".infoBox"),
    buttons = cartELM.find("button");

  buttons.prop("disabled", true);

  let dataForm = {
    orderItemId: orderItem,
  };

  $.ajax({
    type: "post",

    url: "profile/decreaseOrderItem",

    data: dataForm,

    success: function (response) {
      console.log(response);

      let bookId = response.data.orderItem.book_id;

      if (response.data.orderItem.quantity == 0) {
        cartELM.parent().remove();

        if ($("#staticBackdrop8 .modal-body .row .infoBox").length == 0) {
          $("#staticBackdrop8 .modal-body").html(`
                        <div class="alert alert-warning text-center">
                            There is no data in the cart.
                        </div>
                    `);
        }
      } else {
        $(`.infoBox[data-book-id="${bookId}"] h4.subTotal`).text(
          response.data.orderItem.subtotal,
        );

        $(`.infoBox[data-book-id="${bookId}"] input`).val(
          response.data.orderItem.quantity,
        );
      }

      $("#totalPrice").text(response.data.totalPrice);

      buttons.prop("disabled", false);
    },

    error: function (response) {
      let errors = response.responseJSON.data;

      showErrors(errors);

      buttons.prop("disabled", false);
    },
  });
}

function deleteOrderItem(orderItem, btn) {
  let cartELM = $(btn).parents(".infoBox"),
    buttons = cartELM.find("button");

  buttons.prop("disabled", true);

  let dataForm = {
    orderItemId: orderItem,
  };

  $.ajax({
    type: "post",

    url: "profile/deleteOrderItem",

    data: dataForm,

    success: function (response) {
      cartELM.parent().remove();
      if ($("#staticBackdrop8 .modal-body .row .infoBox").length == 0) {
        $("#staticBackdrop8 .modal-body").html(`
                    <div class="alert alert-warning text-center">
                        There is no data in the cart.
                    </div>
                `);
      }
    },
    error: function (response) {
      let errors = response.responseJSON.data;

      showErrors(errors);

      buttons.prop("disabled", false);
    },
  });
}

function fireOrder(orderId) {
  let dataForm = {
    orderId: orderId,
  };

  $.ajax({
    type: "post",
    url: "profile/fireOrder",
    data: dataForm,
    success: function (response) {
      let modalElement = document.getElementById("staticBackdrop8");
      let modal = bootstrap.Modal.getOrCreateInstance(modalElement);

      $("#countOfOrders").html("0");

      let statEl = $("#totalOrdersOrderdCount");
      let currentCount = parseInt(statEl.text()) || 0;
      statEl.text(currentCount + 1);

      modal.hide();

      $.ajax({
        type: "post",
        url: "profile/getOrderedOrders",
        success: function (response) {
          $("#ordered").html(response);
        },
        error: function (response) {
          console.log(response);
        },
      });
    },

    error: function (response) {
      let errors = response.responseJSON.data;
      showErrors(errors);
    },
  });
}

function getDoneOrders(orderId) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, accept it!",
  }).then((result) => {
    if (!result.isConfirmed) {
      return;
    }

    $.ajax({
      type: "post",
      url: "profile/DoneOrders",
      data: { orderId: orderId },

      success: function (response) {
        $(`tr[data-ordered-id="${orderId}"]`).remove();

        $.ajax({
          type: "post",
          url: "profile/getDoneOrdersList",
          success: function (res) {
            $("#Done").html(res);
          },
          error: function (res) {
            console.log(res);
          },
        });

        Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        }).fire({
          icon: "success",
          title: "Order Has Been Accepted Successfully",
        });
      },

      error: function (response) {
        console.log(response);
      },
    });
  });
}

function setOrderId(orderId) {
  $("#staticBackdrop9").data("order-id", orderId);
}

function cancelOrder() {
  let orderIdData = $("#staticBackdrop9").data("order-id");
  let reason = $("#cancelReason").val().trim();

  let data = {
    orderId: orderIdData,
    reason: reason,
  };

  $.ajax({
    type: "post",
    url: "profile/CancelOrders",

    data: data,

    success: function (response) {
      console.log(response);

      if (response.data.error) {
        $("#cancelOrderForm .errorCon").html(`
                    <p class="alert alert-danger mt-2 mb-2">
                        ${response.data.error}
                    </p>
                `);
      } else {
        $("#cancelOrderForm .errorCon").html(``);

        let modalElement = document.getElementById("staticBackdrop9");

        let modal = bootstrap.Modal.getOrCreateInstance(modalElement);

        modal.hide();

        let orderedRow = $(`tr[data-ordered-id="${orderIdData}"]`);

        let orderId = orderIdData;

        let customer = orderedRow.find("td").eq(0).text().trim();

        let totalPrice = orderedRow.find("td").eq(1).text().trim();

        let createdAt = orderedRow.find("td").eq(3).text().trim();

        $("#canceledOrders").prepend(`

                    <tr data-canceled-id="${orderId}">

                        <th scope="row">
                            ${orderId}
                        </th>

                        <td class="text-center">
                            ${customer}
                        </td>

                        <td class="text-center">
                            ${totalPrice}
                        </td>

                        <td class="text-center">

                            <a href="#"
                               onclick="getItemsIntoCart(${orderId}, 'showOrder'); return false;">

                                Show

                            </a>

                        </td>

                        <td class="text-center">
                            ${createdAt}
                        </td>

                    </tr>

                `);

        // Remove From Ordered Table
        orderedRow.remove();

        Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,

          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;

            toast.onmouseleave = Swal.resumeTimer;
          },
        }).fire({
          icon: "success",
          title: "Order Has Been Cancelled Successfully",
        });
      }
    },

    error: function (response) {
      console.log(response);
    },
  });
}
