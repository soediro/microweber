<?

$data = array ();
	 $data['id'] = $params['id'];
							 
							$ord = CI::model ( 'cart' )->ordersGet ( $data, $limit = false );
							
							
							// p($ord);
							
							
							$data = array ();
	 $data['order_id'] = $ord[0]['order_id'];
							
 
							
							$items = CI::model ( 'cart' )->itemsGet($data);
							//p($items);
							$order = $ord[0];

?>

<div class="mw_box left" style="width: 48%">
  <div class="mw_box_header">
    <h3>Order Information</h3>
  </div>
  <div class="mw_box_content">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="orders_table">
      <tr>
        <th scope="col">Item name</th>
        <th scope="col">Qty</th>
        <th scope="col">Single price</th>
        <th scope="col">Total price</th>
      </tr>
      <? foreach($items as $item): ?>
      <tr>
        <td class="edit_order_cell"><strong>
          <?  print $item['item_name']  ?>
          </strong>
          <?  if(!empty($item['custom_fields'])) :  ?>
          <br />
          <? foreach( $item['custom_fields'] as $cf): ?>
          <?   print ($cf['custom_field_name']);	?>
          :
          <?   print ($cf['custom_field_value']);	?>
          <br />
          <?  endforeach;  ?>
          <? endif;?></td>
        <td><?  print $item['qty']  ?></td>
        <td><?  print $item['price']  ?></td>
        <td class="order_totals"><?  print $item['price']*$item['qty']  ?></td>
      </tr>
      <?  endforeach;  ?>
      <tr class="orders_table_bord">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
       <!--<tr>
        <td style="border: none"></td>
        <td style="border: none"></td>
        <td>Subtotal:</td>
        <td class="order_totals">$175,00</td>
      </tr>
     <tr>
        <td style="border: none"></td>
        <td style="border: none"></td>
        <td>Promo Codes:</td>
        <td class="order_totals">- $35,00</td>
      </tr>-->
      <tr>
        <td style="border: none"></td>
        <td style="border: none"></td>
        <td>Shipping price:</td>
        <td class="order_totals">$<? print floatval($order['shipping']); ?></td>
      </tr>
      <tr>
        <td style="border: none"></td>
        <td style="border: none"></td>
        <td>Total:</td>
        <td class="order_totals">$<? print $order['amount']; ?></td>
      </tr>
    </table>
  </div>
</div>
<div class="mw_box right" style="width: 48%">
  <div class="mw_box_header">
    <h3>Customer Information </h3>
  </div>
  <div class="mw_box_content">
    <table>
      <tr>
        <td>Names</td>
        <td class="orange"><? print $order['names']; ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><a href="mailto:<? print $order['email']; ?>"><? print $order['email']; ?></a></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><? print $order['phone']; ?></td>
      </tr>
     <!-- <tr>
        <td>Customer Group </td>
        <td><strong>General</strong></td>
      </tr>-->
    </table>
    <br />
    <br />
    <table>
      <tr>
        <td>
        
        <? // p($ord); ?> 
        
        <h4>Shipping Address</h4>
        <br />
<strong>City:</strong> <? print $order['city']; ?><br />
<strong>State:</strong> <? print $order['state']; ?><br />
<strong>Zip:</strong> <? print $order['zip']; ?><br />
<strong>Address:</strong> <? print $order['address']; ?><br />
 


       </td>
        <td><a class="admin_map_link" target="_blank"
                    href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<? print $order['city']; ?>,<? print $order['address']; ?>&amp;ie=UTF8&amp;t=k&amp;hq=&amp;hnear=<? print $order['city']; ?>&amp;z=14"> <img src="http://maps.google.com/maps/api/staticmap?center=<? print $order['city']; ?>,<? print $order['address']; ?>&zoom=15&size=185x137&sensor=false&markers=color:red%7C<? print $order['city']; ?>" alt="" /> <span>See Location on map</span> </a></td>
      </tr>
    </table>
    
  </div>
</div>
