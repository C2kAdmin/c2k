<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desglose de Factura de Electricidad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            margin-top: 20px;
            page-break-before: always;
        }
    </style>
</head>
<body>
    <h1>Desglose de la Factura de Electricidad</h1>
    <p><strong>Fecha de emisión:</strong> 26 de Noviembre 2023</p>
    <p><strong>Período correspondiente:</strong> 13/10/2023 al 15/11/2023</p>

    <table>
        <tr>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Tipo</th>
        </tr>
        <tr>
            <td><strong>Servicio Eléctrico:</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Administración del Servicio</td>
            <td>$1.655</td>
            <td>Consumo eléctrico del mes</td>
        </tr>
        <tr>
            <td>Transporte de Electricidad</td>
            <td>$11.140</td>
            <td>Consumo eléctrico del mes</td>
        </tr>
        <tr>
            <td>Electricidad Consumida (558 kWh)</td>
            <td>$82.941</td>
            <td>Consumo eléctrico del mes</td>
        </tr>
        <tr>
            <td>Cargo por Servicio Público</td>
            <td>$391</td>
            <td>Consumo eléctrico del mes</td>
        </tr>
        <tr>
            <td>Cargo Fondo de Estabilización Ley 21.472</td>
            <td>$452</td>
            <td>Consumo eléctrico del mes</td>
        </tr>
        <tr>
            <td>Convenio de Pago CNR (2/24)</td>
            <td>$16.200</td>
            <td>Convenio</td>
        </tr>
        <tr>
            <td>Convenio de Pago Energía (19/24)</td>
            <td>$39.170</td>
            <td>Convenio</td>
        </tr>
        <tr>
            <td><strong>Otros cargos (no implica corte):</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Ajuste para facilitar el pago en efectivo, mes actual</td>
            <td>-$17</td>
            <td>Ajuste</td>
        </tr>
        <tr>
            <td>Ajuste para facilitar el pago en efectivo, mes anterior</td>
            <td>$11</td>
            <td>Ajuste</td>
        </tr>
        <tr>
            <td>Interés por mora Energía</td>
            <td>$6.864</td>
            <td>Intereses por mora</td>
        </tr>
        <tr>
            <td>Interés por mora Energía</td>
            <td>$47</td>
            <td>Intereses por mora</td>
        </tr>
        <tr>
            <td>Cargo Pago Fuera Plazo</td>
            <td>$146</td>
            <td>Cargo por retraso</td>
        </tr>
        <tr>
            <td><strong>Consumo Impago de meses anteriores (Saldo anterior energía)</strong></td>
            <td>$243.500</td>
            <td>Deuda acumulada</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Tipo</th>
        </tr>
        <tr>
            <td><strong>Monto Exento a Impuesto</strong></td>
            <td>$56.254</td>
            <td>Consumo eléctrico del mes y otros cargos no afectos a impuesto</td>
        </tr>
        <tr>
            <td><strong>Monto Neto Afecto a Impuesto</strong></td>
            <td>$86.341</td>
            <td>Consumo eléctrico del mes y convenios/intereses</td>
        </tr>
        <tr>
            <td><strong>IVA</strong></td>
            <td>$16.405</td>
            <td>Impuesto sobre el monto neto afecto a impuesto</td>
        </tr>
        <tr>
            <td><strong>Total Boleta</strong></td>
            <td>$159.000</td>
            <td>Suma del consumo eléctrico del mes y convenios/intereses</td>
        </tr>
        <tr>
            <td><strong>Total a pagar</strong></td>
            <td>$402.500</td>
            <td>Incluye el saldo anterior</td>
        </tr>
    </table>

    <div class="summary">
        <h2>Resumen Final</h2>
        <table>
            <tr>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Tipo</th>
            </tr>
            <tr>
                <td><strong>Consumo eléctrico del mes (sin convenios, intereses y retrasos)</strong></td>
                <td>$96.579</td>
                <td>Consumo eléctrico del mes</td>
            </tr>
            <tr>
                <td><strong>Convenios, intereses y cargos por retraso o mora</strong></td>
                <td>$62.421</td>
                <td>Convenio, intereses, y ajustes</td>
            </tr>
            <tr>
                <td><strong>Total Boleta</strong></td>
                <td>$159.000</td>
                <td>Suma del consumo eléctrico del mes y convenios/intereses</td>
            </tr>
            <tr>
                <td><strong>Consumo Impago de meses anteriores (Saldo anterior energía)</strong></td>
                <td>$243.500</td>
                <td>Deuda acumulada</td>
            </tr>
            <tr>
                <td><strong>Total a pagar</strong></td>
                <td>$402.500</td>
                <td>Incluye el saldo anterior</td>
            </tr>
        </table>

        <h2>Conclusión:</h2>
        <p>Para el período de facturación del 13/10/2023 al 15/11/2023:</p>
        <ul>
            <li><strong>Total del consumo de electricidad del mes (sin incluir deudas anteriores):</strong> $96.579</li>
            <li><strong>Convenios, intereses y cargos por retraso o mora:</strong> $62.421</li>
            <li><strong>Total Boleta:</strong> $159.000</li>
        </ul>
        <p>Por lo tanto:</p>
        <ul>
            <li><strong>Consumo eléctrico total con IVA incluido:</strong> $96.579</li>
            <li><strong>Valor total correspondiente a Convenio, intereses y cargos por retraso o mora:</strong> $62.421</li>
        </ul>
    </div>
</body>
</html>
