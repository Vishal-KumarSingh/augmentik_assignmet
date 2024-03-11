<?php
include('../include/header.php');
    $pricingplans = mysqli_query($connection, "SELECT * FROM `pricing_plans` WHERE `delete_flag` = 0") or die(mysqli_error($connection));
?>
        <div class="flex flex-col px-3 py-10 md:p-10 bg-white rounded-3xl border border-gray-300 shadow-xl h-full justify-center items-center">
            <h1 class="text-3xl md:text-5xl font-semibold">Plans & Pricing</h1>
            <p class="opacity-50 text-center md:text-base text-sm">
                No terms and conditions, find the simple pricing
            </p>

            <div class="flex mt-7 text-xl font-medium gap-4">
                <h1 class="md:block hidden">Billed Annually</h1>
                <h1 class="block md:hidden">Annually</h1>
                <div class="toggle">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" id="myCheckbox" class="sr-only peer" />
                        <div class="relative w-11 h-6 bg-green-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                        </div>
                    </label>
                </div>
                <h1 class="md:block hidden">Billed Monthly</h1>
                <h1 class="block md:hidden">Monthly</h1>
            </div>

            <div class="flex flex-wrap items-center jsutify-between mt-10">
                <?php
                $i = 1;
                $class = '';
                while ($row = mysqli_fetch_assoc($pricingplans)) {
                    $features = mysqli_query($connection, "SELECT * FROM `plan_pricing_features` WHERE `planpricingId` = '" . $row['id'] . "' AND `delete_flag` = 0") or die(mysqli_error($connection));
                    if (mysqli_num_rows($features) > 0) {
                        if ($row['billing_frequency'] == "Monthly") {
                ?>
                            <div style="max-width: 305px; height: 700px; display: flex" class="divToHide flex-col items-center justify-around gap-2 mx-4 my-5 py-7 px-12 md:px-24 border bg-white border-gray-300 h-fit rounded-xl shadow-xl" >
                                <h1 class="text-3xl md:text-4xl font-bold"><?php echo $row['plan_name']; ?> Pack</h1>
                                <h2 class="text-3xl font-bold">
                                    <?php echo $row['price'] ?>$<span class="font-normal text-lg">/month</span>
                                </h2>
                                <?php
                                while ($featRow = mysqli_fetch_assoc($features)) {
                                ?>
                                    <div class="flex gap-3 text-sm font-sans text-gray-500 mt-1" style="width: 260px;">
                                        <img src="../../assets/website-images/checkmark.svg" />
                                        <?php echo $featRow['features']; ?>
                                    </div>
                                <?php
                                }
                                ?>

                                <button class="mt-4 flex gap-4 justify-center items-center w-fit self-center border hover:bg-blue-700 rounded-lg border-white bg-[#2D2C2C] font-medium text-sm md:text-lg text-white px-5 md:px-10 py-2 md:rounded-xl">
                                    View Details
                                </button>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div style="max-width: 305px; height: 700px; display: none;" class="divToShow flex-col items-center justify-around gap-2 mx-4 my-5 py-7 px-12 md:px-24 border bg-white border-gray-300 h-fit rounded-xl shadow-xl" >
                                <h1 class="text-3xl md:text-4xl font-bold"><?php echo $row['plan_name']; ?> Pack</h1>
                                <h2 class="text-3xl font-bold">
                                    <?php echo $row['price'] ?>$<span class="font-normal text-lg">/month</span>
                                </h2>
                                <?php
                                while ($featRow = mysqli_fetch_assoc($features)) {
                                ?>
                                    <div class="flex gap-3 text-sm font-sans text-gray-500 mt-1" style="width: 260px;">
                                        <img src="../../assets/website-images/checkmark.svg" />
                                        <?php echo $featRow['features']; ?>
                                    </div>
                                <?php
                                }
                                ?>

                                <button class="mt-4 flex gap-4 justify-center items-center w-fit self-center border hover:bg-blue-700 rounded-lg border-white bg-[#2D2C2C] font-medium text-sm md:text-lg text-white px-5 md:px-10 py-2 md:rounded-xl">
                                    View Details
                                </button>
                            </div>
                <?php
                        }
                    }
                    $i++;
                }
                ?>
            </div>
        </div>
        <?php 
        include('../include/footer.php');
        ?>
    <script>
        $(document).ready(function() {
            $('#myCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.divToHide').css('display', 'none');
                    $('.divToShow').css('display', 'flex');
                } else {
                    $('.divToHide').css('display', 'flex');
                    $('.divToShow').css('display', 'none');
                }
            });
        });
    </script>
</body>

</html>