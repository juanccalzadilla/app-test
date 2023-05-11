<?php
//Item 
//showItem : true | false
//Type: dropdown | link
//Name: String
//Link: String?
//Icon: String
//Dropdown: Array
//DrowpdownLinks Array
//DropdownItemName: String
//DropdownItemLink: String
//DropdownItemIcon: String
$sidebarOptions = [
    [
        "type" => "link",
        "name" => "Inicio",
        "link" => "index_persona.php",
        "icon" => "fas fa-home",
        "showItem" => true
    ],
    [
        "type" => "dropdown",
        "name" => "Contactos",
        "icon" => "fas fa-user",
        "links" => ['categorias.php', 'subcategorias.php', 'productos.php'],
        "showItem" => true,
        "dropdown" => [
            [
                "name" => "Clientes",
                "link" => "categorias.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ],
            [
                "name" => "Proveedores",
                "link" => "subcategorias.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ],
            [
                "name" => "Trabajadores",
                "link" => "productos.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ]
        ]
    ],
    [
        "type" => "link",
        "name" => "Mis documentos",
        "link" => "documentos.php",
        "icon" => "fas fa-download",
        "showItem" => true
    ],
    [
        "type" => "link",
        "name" => "Mis expedientes",
        "link" => "expedientes.php",
        "icon" => "fas fa-folder",
        "showItem" => true
    ],
    [
        "type" => "dropdown",
        "name" => "Ventas",
        "icon" => "fas fa-file-invoice-dollar",
        "links" => ['facturas.php', 'facturasRecurrentes.php'],
        "showItem" => true,
        "dropdown" => [
            [
                "name" => "Facturas",
                "link" => "facturas.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ],
            [
                "name" => "Facturas recurrentes",
                "link" => "facturasRecurrentes.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ],
        ]
    ],
    [
        "type" => "dropdown",
        "name" => "Compras",
        "icon" => "fas fa-shopping-cart",
        "links" => ['compras.php'],
        "showItem" => true,
        "dropdown" => [
            [
                "name" => "Facturas",
                "link" => "compras.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ],
        ]
    ],
    [
        "type" => "dropdown",
        "name" => "Informes",
        "icon" => "fas fa-chart-line",
        "links" => ['informes.php'],
        "showItem" => true,
        "dropdown" => [
            [
                "name" => "Impuestos",
                "link" => "impuestos.php",
                "icon" => "fas fa-list",
                "showItem" => true
            ],
        ]
    ],
];
