<?php
include('../include/header.php');
$tickets = mysqli_query($connection, "SELECT * FROM `support_ticket` WHERE `customerId` = '" . $customerId . "' AND `delete_flag` = 0") or die(mysqli_error($connection));
?>
        <!-- goes here -->
        <div class="div flex items-center h-full gap-10">
            <div class="basis-1/4 hidden md:flex flex-col gap-4 text-lg">
                <h1 class="text-2xl font-semibold">All Tickets</h1>
                <hr />
                <div>
                    <div class="text-[#FFDE30] flex gap-3 items-center">
                        <div class="dot w-4 bg-[#FFDE30] h-4 rounded-full"></div>
                        Pending Tickets
                    </div>
                    <p class="opacity-50">Resolved</p>
                </div>
                <h1 class="text-2xl font-semibold mt-5">Recent Orders</h1>
                <hr />
                <div class="flex flex-col bg-white border border-gray-400 p-5 rounded-xl font-sans">
                    <div class="flex justify-between gap-2">
                        <p class="opacity-75 font-semibold">#123123</p>
                        <p class="opacity-50 text-base font-semibold">22-02-2024</p>
                    </div>
                    <p class="text-xl">4000 Google Reviews</p>
                </div>
                <div class="flex flex-col bg-white border border-gray-400 p-5 rounded-xl font-sans">
                    <div class="flex justify-between gap-2">
                        <p class="opacity-75 font-semibold">#123123</p>
                        <p class="opacity-50 text-base font-semibold">22-02-2024</p>
                    </div>
                    <p class="text-xl">4000 Google Reviews</p>
                </div>
                <div class="flex flex-col bg-white border border-gray-400 p-5 rounded-xl font-sans">
                    <div class="flex justify-between gap-2">
                        <p class="opacity-75 font-semibold">#123123</p>
                        <p class="opacity-50 text-base font-semibold">22-02-2024</p>
                    </div>
                    <p class="text-xl">4000 Google Reviews</p>
                </div>
            </div>
            <div class="w-full md:basis-3/4 flex flex-col gap-5 md:gap-10 items-center justify-center">
                <div class="text-2xl md:text-4xl font-semibold text-center flex justify-between md:w-fit w-full px-2 items-center">
                    <h1>Support Tickets</h1>
                    <button class="flex md:hidden gap-4 justify-center items-center w-fit self-center border hover:bg-blue-700 rounded-lg border-white bg-[#2D2C2C] font-medium text-sm md:text-lg text-white px-5 md:px-10 py-2 md:rounded-xl">
                        Add New
                    </button>
                </div>
                <div class="flex flex-col text-xs md:text-sm gap-3 md:gap-5 overflow-auto max-h-[300px] w-[325px] sm:w-full bg-white px-3 md:px-10 py-5 border-gray-200 rounded-2xl border shadow-xl">
                    <div class="grid place-items-center grid-cols-6 gap-4 place-items-center font-sans md:w-full w-[600px] md:w-[700px] text-sm md:text-lg">
                        <b>Date</b>
                        <b>Ticket ID</b>
                        <b>Support Type</b>
                        <b>Status</b>
                        <b class="col-span-2">Operations</b>
                    </div>
                    <hr />
                    <?php
                    while ($row = mysqli_fetch_assoc($tickets)) {
                        $originalDate = $row['last_update_date'];
                        $timestamp = strtotime($originalDate);
                    ?>
                        <div class="grid place-items-center grid-cols-6 gap-4 place-items-center font-sans md:w-full w-[600px] md:w-[700px]">
                            <p><?php echo date('d-m-Y', $timestamp); ?></p>
                            <p><?php echo $row['id']; ?></p>
                            <p><?php echo $row['support_type'] ?></p>
                            <div class="py-1 rounded-full bg-<?php echo $row['status'] == "1" ? 'green' : 'red'; ?>-500 text-white text-center w-full">
                                <?php echo $row['status'] == "1" ? 'Active' : 'Inactive'; ?>
                            </div>
                            <div class="flex gap-3 col-span-2 items-center">
                                <a href="#<?php echo $row['id']; ?>" class="text-yellow-600">View Details</a>
                                <a href="#"><img src="../../assets/website-images/pencil.svg" alt="" /></a>
                                <a href="#"><img src="../../assets/website-images/bin.svg" alt="" /></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <h1 class="text-2xl md:text-4xl font-semibold w-fit md:mt-0 mt-5 md:w-full">
                    Raise a ticket
                </h1>
                <form id="frm" method="post" class="px-4 md:px-10 py-5 grid grid-cols-2 w-full gap-2 md:gap-x-5 md:gap-y-3 rounded-xl border border-gray-300 shadow-xl bg-white text-base md:text-lg">
                    <h1>Full name</h1>
                    <h1>Email Address</h1>
                    <div class="col-span-2 flex justify-between items-center">
                        <div class="w-full mr-3">
                            <input type="text" name="fname" class="w-full border border-gray-200 px-4 py-1 rounded-lg" />
                        </div>
                        <div class="w-full ml-3">
                            <input type="email" name="email" class="w-full border border-gray-200 px-4 py-1 rounded-lg" />
                        </div>
                    </div>
                    <h1>Support Type</h1>
                    <h1>Related Order</h1>
                    <div class="w-full mr-3">
                        <input type="text" name="support_type" class="w-full ml-3 border border-gray-200 px-4 py-1 rounded-lg" />
                    </div>
                    <div class="w-full mr-3">
                        <input name="related_order" type="text" class="w-full mr-3 border border-gray-200 px-4 py-1 rounded-lg" />
                    </div>
                    <h1 class="col-span-2">Subject</h1>
                    <input type="text" name="subject" class="border border-gray-200 px-4 py-1 rounded-lg col-span-2" />
                    <h1 class="col-span-2">Message</h1>
                    <textarea cols="30" rows="5" name="message" class="border border-gray-200 px-4 py-1 rounded-lg col-span-2"></textarea>
                    <div class="col-span-2">
                        <button class="flex gap-4 justify-center items-center mx-auto border hover:bg-blue-700 rounded-lg border-white bg-[#2D2C2C] font-medium text-sm md:text-lg text-white px-5 md:px-10 py-2 md:rounded-xl">
                            <img src="../assets/website-images/plus.svg" alt="" />
                            Raise a New Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end -->
        <?php 
        include('../include/footer.php');
        ?>
    <script>
        $(document).ready(function() {
            $("#frm").validate({
                rules: {
                    fname: {
                        required: true,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 35,
                    },
                    related_order: {
                        required: true,
                        maxlength: 15,
                    },
                    support_type: {
                        required: true,
                        maxlength: 15,
                    },
                    subject: {
                        required: true,
                        maxlength: 50, // Adjust as needed
                    },
                    message: {
                        required: true,
                        maxlength: 500, // Adjust as needed
                    },
                },
                messages: {
                    fname: {
                        required: "Full Name Required",
                        maxlength: "Full Name should not exceed 20 characters",
                    },
                    email: {
                        required: "Email Required",
                        email: "Invalid Email",
                        maxlength: "Email should not exceed 35 characters",
                    },
                    related_order: {
                        required: "Related Order Required",
                        maxlength: "Related Order should not exceed 15 characters",
                    },
                    support_type: {
                        required: "Support Type Required",
                        maxlength: "Support type should not exceed 15 characters",
                    },
                    subject: {
                        required: "Subject Required",
                        maxlength: "Subject should not exceed 50 characters",
                    },
                    message: {
                        required: "Message Required",
                        maxlength: "Message should not exceed 500 characters",
                    },
                },
                errorElement: "div",
                errorClass: "error",
                errorPlacement: function(error, element) {
                        error.insertAfter(element);
                },
            });
        });
    </script>
</body>

</html>