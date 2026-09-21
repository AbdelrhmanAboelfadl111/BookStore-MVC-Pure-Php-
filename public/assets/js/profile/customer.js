// function addToCart(bookId, that) {
//     let quantityInput = $(that).next(),
//         quantity = Number(quantityInput.val());
    
//     if (quantity == 0) {
//         return;
//     }
    
//     let dataForm = {
//         bookId: bookId,
//         quantityBooks: quantity
//     };

//     $.ajax({
//         type: "post",
//         url: "profile/AddToCart",
//         data: dataForm,
//         success: function (response) {
//             quantityInput.val("");

//             let totalItems = response.data.totalItems;

//             $("#countOfOrders").text(totalItems);
            
//         },
//         error: function (response) {
//             let errors = response.responseJSON.data;
//             showErrors(errors);
//         },
//     });
//     console.log(bookId,that);
// };

// function getItemsIntoCart(orderId = null, status = "cart") {
//   let formData = {};

//   if (orderId !== null) {
//     formData.orderId = orderId;
//   }

//   $.ajax({
//     type: "post",
//     url: "profile/getItemsIntoCart",
//     data: formData,

//     success: function (response) {
//       console.log("FULL RESPONSE:", response);

//       let books = response.data;

//       if (!books || books.length === 0) {
//         $("#staticBackdrop8 .modal-body").html(`
//                     <div class="alert alert-warning text-center">
//                         There is no data in the cart.
//                     </div>
//                 `);

//         let modal = bootstrap.Modal.getOrCreateInstance(
//           document.getElementById("staticBackdrop8"),
//         );

//         modal.show();

//         return;
//       }

//       let modalBody = $("#staticBackdrop8 .modal-body");

//       modalBody.html(`
//                 <h5>
//                     Total :
//                     <span class="text-success" id="totalPrice">
//                         ${books[0].total_price}
//                     </span>
//                 </h5>

//                 <div class="row"></div>

//                 ${
//                   status == "cart"
//                     ? `
//                             <button
//                                 class="btn btn-success m-auto"
//                                 onclick="fireOrder(${books[0].order_id})">
//                                 Order Now
//                             </button>
//                         `
//                     : ""
//                 }
//             `);

//       for (let book of books) {
//         modalBody.find(".row").append(bookComponent(book, status));
//       }

//       let modal = bootstrap.Modal.getOrCreateInstance(
//         document.getElementById("staticBackdrop8"),
//       );

//       modal.show();
//     },

//     error: function (response) {
//       console.log("ERROR:", response);

//       let errors = response.responseJSON?.data;

//       if (errors) {
//         showErrors(errors);
//       }
//     },
//   });
// }

// function bookComponent(book, status) {

//     let additionalRows = "";

//     if (status == "books") {

//         additionalRows = `
//             <div class='gender mb-2 d-flex'>
//                 <h4 class='lable fw-bold'>Stock :</h4>
//                 <h4 class='info'>${book["stock"]}</h4>
//             </div>
//         `;

//         // Add To Cart يظهر للـ customer فقط
//         if (userRole == "customer") {
//             additionalRows += `
//                 <div class="input-group mb-3">
//                     <button
//                         class="btn btn-outline-success"
//                         type="button"
//                         onclick="addToCart(${book["book_id"]}, this)">
//                         Add To Cart
//                     </button>

//                     <input
//                         type="number"
//                         class="form-control text-center"
//                         placeholder="Quantity"
//                         min="1"
//                         id="input-quantity-${book["book_id"]}">
//                 </div>
//             `;
//         }

//     } else if (status == "cart") {

//         additionalRows = `
//             <div class='gender mb-2 d-flex'>
//                 <h4 class='lable fw-bold'>Subtotal :</h4>
//                 <h4 class='info subTotal'>${book["subtotal"]}</h4>
//             </div>

//             <div class="input-group mb-3">
//                 <button
//                     class="btn btn-outline-danger"
//                     type="button"
//                     onclick="decreaseOrderItem(${book["order_item_id"]}, this)">
//                     -
//                 </button>

//                 <input
//                     type="number"
//                     class="form-control text-center"
//                     value="${book["quantity"]}"
//                     disabled>

//                 <button
//                     class="btn btn-outline-success"
//                     type="button"
//                     onclick="increaseOrderItem(${book["order_item_id"]}, this)">
//                     +
//                 </button>
//             </div>

//             <div
//                 class="btn btn-danger w-50 m-auto"
//                 onclick="deleteOrderItem(${book["order_item_id"]}, this)">
//                 Remove
//             </div>
//         `;
//     }

//     return `
//         <div class='col-lg-6 column'>
//             <div class='infoBox h-100' data-book-id="${book["book_id"]}">

//                 <div class='imgCon'>
//                     <img src='${imgPath(
//                         book.image == null
//                             ? "book.png"
//                             : `uploads/${book.image}`,
//                     )}'>
//                 </div>

//                 <div class='nameCon mb-3'>
//                     <h4>${book["title"]}</h4>
//                 </div>

//                 <div class='infoCon mb-2 d-flex flex-column justify-content-center'>

//                     <div class='mail mb-2 d-flex'>
//                         <h4 class='lable fw-bold'>Author :</h4>
//                         <h4 class='info'>${book["authors_name"]}</h4>
//                     </div>

//                     <div class='gender mb-2 d-flex'>
//                         <h4 class='lable fw-bold'>Price :</h4>
//                         <h4 class='info'>${book["price"]}</h4>
//                     </div>

//                     ${additionalRows}

//                 </div>
//             </div>
//         </div>
//     `;
// }

// function increaseOrderItem(orderItem,btn) {

//     let cartELM = $(btn).parents(".infoBox"),
//         buttons = cartELM.find('button');
    
//     buttons.prop('disabled', true);

//     let dataForm = {
//         orderItemId: orderItem,
//     };
//     $.ajax({
//         type: "post",
//         url: "profile/increaseOrderItem",
//         data: dataForm,
//         success: function (response) {
//             let bookId = response.data.orderItem.book_id;

//             $(`.infoBox[data-book-id = "${bookId}"] h4.subTotal`).text(response.data.orderItem.subtotal);

//             $(`.infoBox[data-book-id = "${bookId}"] input`).val(response.data.orderItem.quantity);

//             $(`#totalPrice`).text(response.data.totalPrice);

//             buttons.prop("disabled", false);

//         },
//         error: function (response) {
//             let errors = response.responseJSON.data;
//             showErrors(errors);
//         },
//     });
// };

// function decreaseOrderItem(orderItem, btn) {

//     let cartELM = $(btn).parents(".infoBox"),
//         buttons = cartELM.find("button");

//     buttons.prop("disabled", true);

//     let dataForm = {
//         orderItemId: orderItem,
//     };

//     $.ajax({

//         type: "post",

//         url: "profile/decreaseOrderItem",

//         data: dataForm,

//         success: function (response) {

//             console.log(response);

//             let bookId = response.data.orderItem.book_id;


//             if (response.data.orderItem.quantity == 0) {

//                 cartELM.parent().remove();


//                 if ($("#staticBackdrop8 .modal-body .row .infoBox").length == 0) {

//                     $("#staticBackdrop8 .modal-body").html(`
//                         <div class="alert alert-warning text-center">
//                             There is no data in the cart.
//                         </div>
//                     `);

//                 }

//             } else {

//                 $(`.infoBox[data-book-id="${bookId}"] h4.subTotal`).text(
//                     response.data.orderItem.subtotal
//                 );

//                 $(`.infoBox[data-book-id="${bookId}"] input`).val(
//                     response.data.orderItem.quantity
//                 );

//             }


//             $("#totalPrice").text(response.data.totalPrice);

//             buttons.prop("disabled", false);

//         },

//         error: function (response) {

//             let errors = response.responseJSON.data;

//             showErrors(errors);

//             buttons.prop("disabled", false);

//         },

//     });

// };

// function deleteOrderItem(orderItem, btn) {
//     let cartELM = $(btn).parents(".infoBox"),
//         buttons = cartELM.find("button");
    
//     buttons.prop("disabled", true);

//     let dataForm = {
//         orderItemId: orderItem,
//     };

//     $.ajax({
//         type: "post",

//         url: "profile/deleteOrderItem",

//         data: dataForm,

//         success: function (response) {
//             cartELM.parent().remove();
//             if (
//                 $("#staticBackdrop8 .modal-body .row .infoBox").length == 0
//             ) {
//                 $("#staticBackdrop8 .modal-body").html(`
//                     <div class="alert alert-warning text-center">
//                         There is no data in the cart.
//                     </div>
//                 `);
//             }
//         },
//         error: function (response) {
//             let errors = response.responseJSON.data;

//         showErrors(errors);

//             buttons.prop("disabled", false);
//         },
//     });
// };

// function fireOrder(orderId) {
//   let dataForm = {
//     orderId: orderId,
//   };

//   $.ajax({
//     type: "post",
//     url: "profile/fireOrder",
//     data: dataForm,
//     success: function (response) {
//       let modalElement = document.getElementById("staticBackdrop8");
//       let modal = bootstrap.Modal.getOrCreateInstance(modalElement);

//       $("#countOfOrders").html("0");

//       // ✅ تحديث عداد "Pending Orders" في تبويب الإحصائيات فورًا
//       let statEl = $("#totalOrdersOrderdCount");
//       let currentCount = parseInt(statEl.text()) || 0;
//       statEl.text(currentCount + 1);

//       modal.hide();

//       // Get updated ordered orders
//       $.ajax({
//         type: "post",
//         url: "profile/getOrderedOrders",
//         success: function (response) {
//           $("#ordered").html(response);
//         },
//         error: function (response) {
//           console.log(response);
//         },
//       });
//     },

//     error: function (response) {
//       let errors = response.responseJSON.data;
//       showErrors(errors);
//     },
//   });
// }





