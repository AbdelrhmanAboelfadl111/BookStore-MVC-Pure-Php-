<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-100">
            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Name</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= route('/profile/editName') ?>" class="w-100">
                <div class="modal-body w-100">
                    <input type="text" name="editName" placeholder="Name" value="<?= auth('name') ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-100">
            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= route('/profile/editEmail') ?>" class="w-100">
                <div class="modal-body w-100">
                    <input type="email" name="editEmail" placeholder="Email" value="<?= auth('email') ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-100">
            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Gender</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= route('/profile/editGender') ?>" class="w-100">
                <div class="modal-body w-100">
                    <select name="editGender" id="">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-100">
            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= route('/profile/editPassword') ?>" class="w-100">
                <div class="modal-body w-100">
                    <input type="password" name="editPassword" placeholder="Password">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-100">
            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= route('/profile/') ?> class"="w-100">
                <div class="modal-body w-100">
                    <input type="text" class="mb-3" name="Title" placeholder="Title">
                    <input type="number" class="mb-3" name="price" placeholder="Price">
                    <input type="number" name="quantity" class="mb-3" placeholder="Quantity">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-100">
            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Author</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="w-100" id="AuthorForm">
                <div class="modal-body w-100">
                    <input type="text" class="mb-3" name="authorName" placeholder="Author Name">
                    <p class="alert alert-danger w-100 mt-3 d-none" data-error-name="authorName"></p>
                    <textarea type="text" class="mb-3" name="authorBio" rows="10" placeholder="AuthorBio"></textarea>
                    <p class="alert alert-danger w-100 mt-3 d-none" data-error-name="authorBio"></p>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop7" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog w-100">
        <div class="modal-content w-100">

            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Add Book
                </h1>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <form method="POST" class="w-100 p-3" id="addBook">

                <!-- Author -->
                <div class="form-group mb-3">

                    <label for="exampleInputName" class="form-label">
                        Author Name
                    </label>

                    <input
                        id="AuthorIdInput"
                        type="text"
                        name="AuthorId"
                        hidden
                        value="">

                    <select
                        name="AuthorName"
                        id="exampleInputName"
                        class="form-control"
                        disabled>
                        <option value="" selected hidden></option>
                    </select>

                    <p
                        class="alert alert-danger w-100 mt-3 d-none"
                        data-error-name="AuthorId">
                    </p>

                </div>


                <!-- Book Title -->
                <div class="form-group mb-3">

                    <label for="BookTitle" class="form-label">
                        Book Title
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="BookTitle"
                        id="BookTitle">

                    <p
                        class="alert alert-danger w-100 mt-3 d-none"
                        data-error-name="BookTitle">
                    </p>

                </div>


                <!-- Book Image -->
                <div class="form-group mb-3">

                    <label for="BookImage" class="form-label">
                        Book Image
                    </label>

                    <input
                        type="file"
                        class="form-control"
                        name="BookImage"
                        id="BookImage">

                    <p
                        class="alert alert-danger w-100 mt-3 d-none"
                        data-error-name="BookImage">
                    </p>

                </div>


                <!-- Description -->
                <div class="form-group mb-3">

                    <label for="BookDes" class="form-label">
                        Book Description
                    </label>

                    <textarea
                        name="BookDes"
                        id="BookDes">
                    </textarea>

                    <p
                        class="alert alert-danger w-100 mt-3 d-none"
                        data-error-name="BookDes">
                    </p>

                </div>


                <!-- Price -->
                <div class="form-group mb-3">

                    <label for="BookPrice" class="form-label">
                        Book Price
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="BookPrice"
                        id="BookPrice">

                    <p
                        class="alert alert-danger w-100 mt-3 d-none"
                        data-error-name="BookPrice">
                    </p>

                </div>


                <!-- Stock -->
                <div class="form-group mb-3">

                    <label for="BookStock" class="form-label">
                        Book Stock
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="BookStock"
                        id="BookStock">

                    <p
                        class="alert alert-danger w-100 mt-3 d-none"
                        data-error-name="BookStock">
                    </p>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop8" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog w-100">
        <div class="modal-content w-100">

            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Cart
                </h1>
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <div class="modal-body">


            </div>




        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop9" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog w-100">
        <div class="modal-content w-100">

            <div class="modal-header w-100">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Cancel Reason
                </h1>
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <form class="w-100 p-3" id="cancelOrderForm">

                    <div class="form-group mb-3">

                        <label for="cancelReason" class="form-label">
                            Cancel Reason
                        </label>

                        <textarea
                            name="cancelReason"
                            id="cancelReason"
                            class="form-control">
                        </textarea>

                        <div class="errorCon">

                        </div>

                        <!-- <p class="alert alert-danger w-100 my-2">Reason is required</p> -->

                        <p
                            class="alert alert-danger w-100 mt-3 d-none"
                            data-error-name="cancelReason">
                        </p>

                        <button type="submit" class="btn btn-danger mt-3 ms-auto" onclick="cancelOrder(); return false;">
                            Cancel Order
                        </button>

                    </div>
                </form>
            </div>




        </div>
    </div>
</div>