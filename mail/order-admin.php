<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <thead>
        <tr style="background: #FFC76C; color: white">
            <th style="padding: 8px; border: 1px solid #ddd;">Назва</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Об'єм</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Ціна за 1шт</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Кількість</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Сума</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($session['cart'] as $id => $product) : ?>
            <?php foreach ($product as $item) : ?>
                <?php if (isset($item['qty'])) : ?>
                    <tr >
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $product['title'] ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['volume'] ?> <span style="text-transform: lowercase"><?= $product['volume-type'] ?></span></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['price']?> грн</td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] * $item['price'] ?> грн</td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <tr>
            <td colspan="4" style="padding: 8px; border: 1px solid #ddd; font-weight: bold">Загальна кількість: </td>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold"><?= $session['cart.qty']?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding: 8px; border: 1px solid #ddd; font-weight: bold">На суму: </td>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold"><?= $session['cart.sum']?> грн</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="user-info">
    <?php
    $address;
    switch ($order->delivery_type){
        case "Нова Пошта":
            $address = $order->city . ", " . $order->department_np;
            break;
        case "Укрпошта":
            $address = $order->city . ", " . $order->street . ", " . $order->index_ukr;
            break;
        case "Кур’єрська доставка":
            $address = $order->city . ", " . $order->street . " " . $order->house_number . ", " . $order->apartment_number . "кв.";
            break;
        case "Самовивіз":
            $address = false;
            break;
    }
    ?>

    <p>Ім'я: <span><?= $order->name?></span></p>
    <p>Прізвище: <span><?= $order->last_name?></span></p>
    <p>Телефон: <span><?= $order->phone?></span></p>
    <p>E-mail: <span><?= $order->email?></span></p>
    <p>Тип доставки: <span><?= $order->delivery_type?></span></p>

    <?php if ($address) : ?>
        <p>Адреса: <span><?= $address?></span></p>
    <?php endif; ?>

    <p>Варіант оплати: <span><?= $order->payment_type?></span></p>
    <p>Констультація: <span><?= ($order->consultation) ? "Потрібна" : "Не потрібна"?></span></p>
    <?php if ($order->note != "") : ?>
        <p>Коментар: <span><?= $order->note?></span></p>
    <?php endif; ?>
</div>