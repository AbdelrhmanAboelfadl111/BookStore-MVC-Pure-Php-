<?php

require_once __DIR__ . "/create_users_table.php";
require_once __DIR__ . "/create_authors_table.php";
require_once __DIR__ . "/create_books_table.php";
require_once __DIR__ . "/create_orders_table.php";
require_once __DIR__ . "/create_order_items_table.php";
require_once __DIR__ . "/create_api_tokens_table.php";

create_users_table::build();
create_authors_table::build();
create_books_table::build();
create_orders_table::build();
create_order_items_table::build();
create_api_tokens_table::build();
