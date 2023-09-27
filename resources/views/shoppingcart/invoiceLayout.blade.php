<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Groene Vingers</title>
</head>

<body>
    <header class="clearfix">
        <h1>{{$title}}</h1>
        <div id="company" class="clearfix">
            <div>Groene Vingers</div>
            <div>Oranjestraat 3, <br />2587 WD, Nuenen,<br /> Nederland</div>
            <div>06-33024999</div>
            <div><a href="mailto:info@groenevingers.nl">info@groenevingers.nl</a></div>
        </div>
        <div id="project">
            <div><span>Naam: </span> {{$address->name}},</div>
            <div><span>Telefoonnummer: </span> {{$address->phonenumber}},</div>
            <div><span>Besteldatum: </span> {{$date}},</div>
            <div><span>Adres: </span><br />{{$address->address}} {{$address->housenumber}},
                <br />{{$address->postcode}},
                {{$address->region}},
                <br />{{$address->province}},
                <br />{{$address->country}}
            </div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Product</th>
                    <th class="desc">Beschrijving</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderlines as $orderline)
                @foreach($products as $product)
                @if($orderline['product_id'] == $product->id)
                <tr>
                    <td class="service">{{$product->name}}</td>
                    <td class="desc">{{$product->description}}</td>
                    <td class="unit">{{$orderline['price']}}</td>
                    <td class="qty">{{$orderline['amount']}}</td>
                    <td class="total">{{$orderline['price'] * $orderline['amount']}}</td>
                </tr>
                <div class="totaalItem">{{$totaal = $totaal + $orderline['price'] * $orderline['amount']}}</div>
                @endif
                @endforeach
                @endforeach
                <tr>
                    <td colspan="4" class="grand total">Totaal</td>
                    <td class="grand total">{{$totaal}}</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>
<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #5D6975;
        text-decoration: underline;
    }

    body {
        position: relative;
        width: 19cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: Arial;
    }

    header {
        padding: 10px 0;
        margin-bottom: 30px;
    }

    .totaalItem {
        display: inline;
        visibility: hidden;
    }

    #logo {
        text-align: center;
        margin-bottom: 10px;
    }

    #logo img {
        width: 90px;
    }

    h1 {
        border-top: 1px solid #5D6975;
        border-bottom: 1px solid #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
    }

    #project {
        float: left;
    }

    #project span {
        display: inline-block;
        font-weight: bold;
    }

    #company {
        float: right;
        text-align: right;
    }

    .companyRepeat {
        float: inline-end;
        left: 88.13%;
        text-align: right;
        /* margin-left: auto; */
    }

    #project div,
    #company div {
        white-space: nowrap;
    }

    #companyRepeat div {
        white-space: nowrap;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 10px;
        overflow: scroll;
    }

    table tr:nth-child(2n-1) td {
        background: #F5F5F5;
    }

    table th,
    table td {
        text-align: center;
    }

    table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
    }

    table .service,
    table .desc {
        text-align: left;
    }

    table td {
        padding: 10px;
        text-align: right;
    }

    table td.service,
    table td.desc {
        vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table td.grand {
        border-top: 1px solid #5D6975;
        ;
    }

    #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
    }

    footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
    }
</style>