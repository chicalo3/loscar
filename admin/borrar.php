<td align="center">TOTAL DEUDA</td><?php  $totaldeuda = 13000;?>
    
    
   <td align="center" bgcolor="#FFFFCC" class="texto-tabla"><?php echo $totaldeuda; ?> €</td>
  </tr>
  <tr>
    <td align="center">TOTAL PAGADO</td>
    
 <?php  $pordevolver = $totaldeuda - $sumatotal; ?>
    <td align="center" bgcolor="#FFFFCC"><?php echo  $sumatotal ; ?> €     </td>
  </tr>
  <tr>
    <td align="center">POR DEVOLVER</td>
   <td align="center"  bgcolor="#FFFFCC"><?php echo $pordevolver ;?> €</td>