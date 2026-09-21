<?php

require_once __DIR__ . "/create_users_table.php";
require_once __DIR__ . "/create_authors_table.php";
require_once __DIR__ . "/create_books_table.php";
require_once __DIR__ . "/create_orders_table.php";
require_once __DIR__ . "/create_order_items_table.php";
require_once __DIR__ . "/create_api_tokens_table.php";

create_api_tokens_table::harmful();
create_order_items_table::harmful();
create_orders_table::harmful();
create_books_table::harmful();
create_authors_table::harmful();
create_users_table::harmful();


