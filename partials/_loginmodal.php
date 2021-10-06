<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginmodalLabel">Log In here</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="container">
                    <form action="/phpprojects/iforum/partials/_loginhandler.php" method="POST" >
                        <div class="mb-3">
                            <label for="loginemail" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="loginemail" id="loginemail"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="loginpassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginpassword" name="loginpassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                </div>








            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>