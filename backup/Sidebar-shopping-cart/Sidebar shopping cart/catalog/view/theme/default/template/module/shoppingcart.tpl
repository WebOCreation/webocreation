<h3><?php echo $heading_title; ?></h3>
<hr>
<div class="row">
    <div class="product-layout col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div id="shoppingcart">
        <span>
        <?php if ($products || $vouchers) { ?>
            <table class="table table-striped">
                <?php foreach ($products as $product) { ?>
                <tr>
                    <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                        <?php if ($product['option']) { ?>
                        <?php foreach ($product['option'] as $option) { ?>
                        <br />
                        - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
                        <?php } ?>
                        <?php } ?>
                        <?php if ($product['recurring']) { ?>
                        <br />
                        - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
                        <?php } ?></td>
                    <td class="text-right"><?php echo $product['quantity']; ?></td>
                    <td class="text-right"><?php echo $product['total']; ?></td>
                    <td class="text-center"><a onclick="cart.remove('<?php echo $product['key']; ?>');" title="<?php echo $button_remove; ?>" ><i class="fa fa-times"></i></a></td>
                </tr>
                <?php } ?>
                <?php foreach ($vouchers as $voucher) { ?>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-left"><?php echo $voucher['description']; ?></td>
                    <td class="text-right">x&nbsp;1</td>
                    <td class="text-right"><?php echo $voucher['amount']; ?></td>
                    <td class="text-center text-danger"><a onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" ><i class="fa fa-times"></i></a></td>
                </tr>
                <?php } ?>
            </table>

            <div>
                <table class="table table-bordered">
                    <?php foreach ($totals as $total) { ?>
                    <tr>
                        <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
                        <td class="text-right"><?php echo $total['text']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <p class="text-right"><a href="<?php echo $cart; ?>"><strong><i class="fa fa-shopping-cart"></i> <?php echo $text_cart; ?></strong></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $checkout; ?>"><strong><i class="fa fa-share"></i> <?php echo $text_checkout; ?></strong></a></p>
            </div>
        <?php } else { ?>
            <p class="text-center"><?php echo $text_empty; ?></p>
        <?php } ?>
        </span>
</div>
</div>
</div>
