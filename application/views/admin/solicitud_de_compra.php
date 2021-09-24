<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 10/09/2021
 * Time: 10:20
 */
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,600;0,800;1,100&family=Roboto:wght@100;300;400;500;700&display=swap"
      rel="stylesheet">
<!-- Place your kit's code here -->
<script src="https://kit.fontawesome.com/fd7d02f666.js" crossorigin="anonymous"></script>
<?php echo $this->section('css_p') ?>
<link href="<?php echo base_url() ?>/ui/public/css/forma_pdf.min.css" rel="stylesheet">
<div class="forma_pdf">
    <div class="forma_pdf_container">
        <table class="table">
            <tr>
                <td class="w-50">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo.png" id="logo">
                    </a>
                </td>
                <td class="w-50 t-center">
                    <span class="titulo">www.GPCOMPRAS.NET</span>
                </td>
            </tr>
            <tr>
                <td class="t-center" colspan="2">

                </td>
            </tr>
            <tr>
                <td class="t-center" colspan="2">
                    <h1>Solicitud de compra ####</h1>
                </td>
            </tr>
        </table>
        <table class="datos_cliente">
            <tr>
                <td class="w-20">Cliente:</td>
                <td></td>
            </tr>
            <tr>
                <td>Puesto:</td>
                <td></td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td></td>
            </tr>
            <tr>
                <td>Puesto</td>
                <td></td>
            </tr>
            <tr>
                <td>Empresa</td>
                <td></td>
            </tr>
            <tr>
                <td>Asociacion solidarista</td>
                <td></td>
            </tr>
        </table>
        <table class="datos_productos w-100">
            <tr>
                <td>
                    Cantidad
                </td>
                <td>Codigo</td>
                <td>Producto</td>
                <td>Precio unidad</td>
                <td>Total</td>
            </tr>
            <tr>
                <td>1</td>
                <td>102</td>
                <td>OLLA DE PRESION DE 9 LITROS BLACK & DECK</td>
                <td>485.00</td>
                <td>485.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>102</td>
                <td>OLLA DE PRESION DE 9 LITROS BLACK & DECK</td>
                <td>485.00</td>
                <td>485.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>102</td>
                <td>OLLA DE PRESION DE 9 LITROS BLACK & DECK</td>
                <td>485.00</td>
                <td>485.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>102</td>
                <td>OLLA DE PRESION DE 9 LITROS BLACK & DECK</td>
                <td>485.00</td>
                <td>485.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>102</td>
                <td>OLLA DE PRESION DE 9 LITROS BLACK & DECK</td>
                <td>485.00</td>
                <td>485.00</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td  class="tl-d">Total:</td>
                <td></td>
            </tr>
        </table>
        <table id="entrega" class="w-100">
            <tr>
                <td>
                    lugar de entrega
                </td>
                <td style="border: 1px solid black"> Km, 16.5 carr salvador arrazola panorama lote 32 codigo 0990</td>
            </tr>
        </table>

        <table class="w-100">
            <tr>
                <td class="w-50">
                    <table>
                        <tr>
                            <td colspan="2">
                                Autorizacion
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nombre
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                Puesto
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                Fecha Autorizacion
                            </td>
                            <td></td>
                        </tr>
                    </table>

                </td>
                <td class="w-50">
                    <table>
                        <tr>
                            <td>
                                Frima de autorizado
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="cuadro_firma">

                                </div>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </div>
</div>



