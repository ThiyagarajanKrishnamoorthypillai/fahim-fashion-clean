<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }

        .header {
            background-color: #0073e6;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #333333;
        }

        .content p {
            color: #555555;
        }

        .quotation-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .quotation-table th,
        .quotation-table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .quotation-table th {
            background-color: #f4f4f4;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Quotation : <?php echo e($mail_data['quotation']->reference_no); ?></h1>
        </div>
        <div class="content">
            <h2>Dear <?php echo e($mail_data['user_name']); ?>,</h2>
            <p>We are pleased to provide you with the following quotation for the requested items:</p>
            <table class="quotation-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $mail_data['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(getProductNameById($details->finishProduct_id)); ?></td>
                            <td><?php echo e($details->description); ?></td>
                            <td><?php echo e($details->quantity_amount); ?></td>
                            <td><?php echo e(getAmtCustom($details->unit_price)); ?></td>
                            <td><?php echo e(getAmtCustom($details->total)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Sub Total</th>
                        <th><?php echo e(getAmtCustom($mail_data['quotation']->subtotal)); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Other</th>
                        <th><?php echo e(getAmtCustom($mail_data['quotation']->other)); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Discount</th>
                        <th><?php echo e(getAmtCustom($mail_data['quotation']->discount)); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Grand Total</th>
                        <th><?php echo e(getAmtCustom($mail_data['quotation']->grand_total)); ?></th>
                    </tr>
                </tfoot>
            </table>
            <p>Please review the quotation and let us know if you have any questions or require further information.</p>
            <p>Thank you for your business!</p>
            <p>Best regards,<br><?php echo e(getCompanyInfo()->company_name); ?></p>
        </div>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(getCompanyInfo()->company_name); ?>. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
<?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\mail\quotation.blade.php ENDPATH**/ ?>