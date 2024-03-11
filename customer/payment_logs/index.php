<?php
include('../include/header.php');
$paymentlog = mysqli_query($connection, "SELECT * FROM `payment_log` WHERE `customerId` = '" . $customerId . "' AND `delete_flag` = 0") or die(mysqli_error($connection));
?>
        <div class="flex flex-col gap-5 md:gap-10">
            <h1 class="text-3xl md:text-5xl font-semibold">Payment Logs</h1>

            <div class="flex flex-col gap-10 p-5 md:px-10 md:py-5 rounded-2xl shadow-xl bg-white border border-gray-300">
                <div class="flex md:flex-row flex-col justify-between w-full gap-4">
                    <h1 class="text-2xl md:text-3xl text-yellow-500 underline font-semibold">
                        45 Total Orders
                    </h1>
                    <div class="flex gap-4 overflow-x-auto items-center">
                        <select class="px-2 md:px-4 py-1 md:py-2 border border-gray-300 rounded-lg bg-white">
                            <option value="">Select User</option>
                        </select>
                        <select class="px-2 md:px-4 py-1 md:py-2 border border-gray-300 rounded-lg bg-white">
                            <option value="">Select Package</option>
                        </select>
                        <select class="px-2 md:px-4 py-1 md:py-2 border border-gray-300 rounded-lg bg-white">
                            <option value="">Select Status</option>
                        </select>
                        <div class="w-96 flex gap-3 items-center">
                            From:
                            <input type="date" class="px-2 md:px-4 py-1 md:py-2 border border-gray-300 rounded-lg bg-white" />
                            To:
                            <input type="date" class="px-2 md:px-4 py-1 md:py-2 border border-gray-300 rounded-lg bg-white" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col text-xs md:text-lg md:text-sm gap-2 md:gap-5 overflow-auto md:w-full max-h-[500px]">
                    <div class="grid text-sm grid-cols-[1fr_2fr_1fr_1fr_1fr_1fr_1fr_1fr] place-items-center font-sans md:w-full w-[700px]">
                        <b>Order No.</b>
                        <b>Order Placed</b>
                        <b>Package</b>
                        <b>Order Status</b>
                        <b>Method</b>
                        <b>Payment Status</b>
                        <b>Total</b>
                        <b>View</b>
                    </div>
                    <hr />
                    <?php
                    while ($row = mysqli_fetch_assoc($paymentlog)) {
                        $originalDate = $row['order_placed'];
                        $timestamp = strtotime($originalDate);
                    ?>
                        <div class="grid grid-cols-[1fr_2fr_1fr_1fr_1fr_1fr_1fr_1fr] place-items-center font-sans md:w-full w-[700px]">
                            <p><?php echo $row['id']; ?></p>
                            <p><?php echo date('m/d/Y h:i A', $timestamp); ?></p>
                            <p><?php echo $row['package']; ?></p>
                            <p><?php echo $row['status']; ?></p>
                            <p><?php echo $row['method']; ?></p>
                            <p><?php echo $row['payment_status']; ?></p>
                            <p class="opacity-50">Rs. <?php echo $row['total']; ?></p>
                            <a class="text-yellow-700">View Details</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="flex md:flex-row flex-col text-sm md:text-lg justify-end gap-2 md:gap-5 items-center opacity-50">
                    <div class="flex gap-2 md:gap-5">
                        <a href="#" class="flex gap-3 items-center justify-center px-2 py-1 md:px-4 md:py-2 border border-gray-300 rounded-lg">
                            <svg class="w-2.5 md:w-3.5 aspect-square me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Prev
                        </a>

                        <p class="flex items-center gap-1 md:gap-3">
                            <span class="underline font-bold">1</span> of 2
                        </p>

                        <a href="#" class="flex gap-3 items-center justify-center px-2 py-1 md:px-4 md:py-2 border border-gray-300 rounded-lg">
                            Next
                            <svg class="w-2.5 md:w-3.5 aspect-square me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex items-center md:gap-5">
                        <p>Per Page:</p>
                        <select class="px-2 md:px-4 py-1 md:py-2 border border-gray-300 rounded-lg bg-white">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
<?php 
    include('../include/footer.php');
?>