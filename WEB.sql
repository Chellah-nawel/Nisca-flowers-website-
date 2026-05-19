create database flower_shop;
use flower_shop;

-- Table des utilisateurs
create table users(
    id int primary key auto_increment,
    username varchar(50) not null,
    email varchar(100) unique not null,
    password varchar(255) not null,
    role enum('customer', 'admin') default 'customer',
    created_at timestamp default current_timestamp
);

-- Table des catégories
create table categories(
    id_category int primary key auto_increment,
    name_category varchar(50) not null
);

-- Table des couleurs
CREATE TABLE colors (
    id_color INT PRIMARY KEY AUTO_INCREMENT,
    name_color VARCHAR(50) unique not null
);

-- Table des produits
create table flowers(
    id_flower int primary key auto_increment,
    name_flower varchar(100) not null,
    price decimal(10, 2) not null,
    description text,
    stock int not null check (stock >= 0),
    id_category int,
    image_url varchar(255),
    is_available boolean default true,
    is_custom BOOLEAN DEFAULT FALSE,
    wrapping_color_id INT,
    created_at timestamp default current_timestamp,
    size ENUM('small','medium','large') DEFAULT 'medium',
    foreign key (id_category) references categories(id_category),
    foreign key (wrapping_color_id) references colors(id_color) ON DELETE SET NULL
);

-- Table des types de fleurs
create table flower_types(
    id_flower_type int primary key auto_increment,
    name varchar(50) unique not null,
    stock_quantity int not null check (stock_quantity >= 0),
    image_url varchar(255) null
);

-- Table associative produits-fleurs 
create table product_flowers(
    id int primary key auto_increment,
    id_flower int not null,
    id_flower_type int not null,
    quantity int not null check (quantity > 0),
    id_color INT,
    FOREIGN KEY (id_color) REFERENCES colors(id_color) ON DELETE SET NULL,
    foreign key (id_flower) references flowers(id_flower) ON DELETE CASCADE,
    foreign key (id_flower_type) references flower_types(id_flower_type) ON DELETE CASCADE,
    unique (id_flower, id_flower_type, id_color)
);

-- Table des favoris
create table favorites(
    id_favorite int primary key auto_increment,
    id_user int,
    id_flower int,
    added_at timestamp default current_timestamp,
    foreign key (id_user) references users(id) ON DELETE CASCADE,
    foreign key (id_flower) references flowers(id_flower) ON DELETE CASCADE,
    unique (id_user, id_flower)
);

-- Table des commandes
create table orders(
    id_order int primary key auto_increment,
    id_user int not null,
    total_price decimal(10, 2) not null,
    order_date timestamp default current_timestamp,
    foreign key (id_user) references users(id) 
    
);

-- Table des bouquets personnalisés
CREATE TABLE custom_bouquets (
    id_custom INT  PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    wrapping_color_id INT,
    total_price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    base_price DECIMAL(10,2),
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (wrapping_color_id) REFERENCES colors(id_color) ON DELETE SET NULL
);

-- Table des items de commande
create table order_items(
    id_order_item int primary key auto_increment,
    id_order int not null,
    id_flower int NULL,
    id_custom INT NULL,
    quantity int not null check (quantity > 0),
    price decimal(10, 2) not null,
    item_note text null,
    foreign key (id_order) references orders(id_order) ON DELETE CASCADE,
    foreign key (id_flower) references flowers(id_flower) ,
    foreign key (id_custom) references custom_bouquets(id_custom) ON DELETE CASCADE,
    CHECK (
    (id_flower IS NOT NULL AND id_custom IS NULL)
    OR
    (id_flower IS NULL AND id_custom IS NOT NULL)
)
);

create table reviews(
    id_review int primary key auto_increment,
    id_user int not null,
    id_flower int not null,
    id_order int not null,
    rating int check (rating >= 1 and rating <= 5),
    comment text,
    review_date timestamp default current_timestamp,
    foreign key (id_user) references users(id) ON DELETE CASCADE,
    foreign key (id_flower) references flowers(id_flower) ON DELETE CASCADE,
    foreign key (id_order) references orders(id_order) ON DELETE CASCADE,
    unique (id_user, id_flower, id_order)
);

-- Table des informations de livraison
create table order_info(
    id_order_info int primary key auto_increment,
    id_order int not null,
    id_user int not null,
    phone varchar(20) not null,
    wilaya varchar(50) not null,
    communes varchar(50) not null,
    address varchar(255) not null,
    customer_name varchar(100) not null,
    instructions text,
    delivery_type varchar(50) DEFAULT 'standard',
    payment_method varchar(50)DEFAULT 'cash_on_delivery',
    delivery_date date,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (id_order) references orders(id_order) ON DELETE CASCADE,
    foreign key (id_user) references users(id) ON DELETE CASCADE
);

-- Table d'historique des statuts 
create table order_status_history(
    id_status_history int primary key auto_increment,
    id_order int not null,
    id_user int not null,
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    changed_by VARCHAR(50) DEFAULT 'system',
    notes TEXT,
    foreign key (id_order) references orders(id_order),
    foreign key (id_user) references users(id)
);

-- Table du panier 
create table cart(
    id_cart int primary key auto_increment,
    id_user int not null,
    created_at timestamp default current_timestamp,
    is_active BOOLEAN DEFAULT TRUE,
    foreign key (id_user) references users(id) ON DELETE CASCADE
);

-- Table des items du panier
create table cart_items(
    id_cart_item int primary key auto_increment,
    id_cart int not null,
    id_flower int null,
    quantity int not null check (quantity > 0),
    added_at timestamp default current_timestamp,
    id_custom INT NULL,
    item_note text null,
    foreign key (id_cart) references cart(id_cart) ON DELETE CASCADE,
    foreign key (id_flower) references flowers(id_flower) ON DELETE CASCADE,
    UNIQUE (id_cart, id_flower, id_custom) ,   
    CHECK (
    (id_flower IS NOT NULL AND id_custom IS NULL)
    OR
    (id_flower IS NULL AND id_custom IS NOT NULL)
)
);

-- Table des compositions de bouquets personnalisés
CREATE TABLE custom_bouquet_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_custom INT not null,
    id_flower_type INT not null,
    id_color INT,
    quantity INT,
    FOREIGN KEY (id_custom) REFERENCES custom_bouquets(id_custom) ON DELETE CASCADE,
    FOREIGN KEY (id_flower_type) REFERENCES flower_types(id_flower_type) ON DELETE CASCADE,
    FOREIGN KEY (id_color) REFERENCES colors(id_color) ON DELETE SET NULL,
    unique (id_custom, id_flower_type, id_color)
);


INSERT INTO users (username, email, password, role) VALUES 
('AdminNisca', 'admin@nisca.com', 'hash_password_admin', 'admin'),
('Sarah06', 'sarah@gmail.com', 'hash_password_user', 'customer');


-- Catégories
INSERT INTO categories (name_category) VALUES 
('Wedding'), ('Birthday'), ('Graduation'), ('Gifts'), ('Anniversary'),('Daily');

-- Couleurs
INSERT INTO colors (name_color) VALUES 
('White'), ('Pink'), ('Red'), ('Yellow'), ('Purple'), ('Green');


INSERT INTO flowers (name_flower, price, description, stock, id_category, image_url, size) VALUES 
('Tulips pop', 2400.00, 'A beautiful mix of fresh tulips.', 50, 2, 'imag/bouquet_tulip.png', 'medium'),
('Romantic Roses', 3500.00, 'Classic red roses for your loved one.', 30, 5, 'imag/bouquet_rose.png', 'large'),
('White Elegance', 2800.00, 'Pure white lilies for a sophisticated touch.', 20, 1, 'imag/bouquet_blac.png', 'medium'),
('Sunny Day', 1500.00, 'Bright sunflowers to light up any room.', 40, 4, 'imag/bouquet_rose4.png', 'small'),
('Purple Dream', 2100.00, 'Elegant purple tulips.', 15, 2, 'imag/bouquet_blue.png', 'medium'),
('Golden Shine', 1800.00, 'Yellow roses for friendship.', 25, 4, 'imag/bouquet_rose2.png', 'small'),
('Deep Red', 4200.00, 'Premium dark red roses.', 10, 5, 'imag/bouquet_rouge.png', 'large');


-- Types de fleurs (pour les compositions)
INSERT INTO flower_types (name, stock_quantity, image_url) VALUES 
('Rose', 500, 'imag/fleure_rouge.png'),
('Tulip', 300, 'imag/fleure_rose.png'),
('Lily', 200, 'imag/fleure_blache.png'),
('Daisy', 400, 'imag/fleure_blue.png'),
('Sunflower', 150, 'imag/fleure_rose2.png');

-- Création d'un panier active pour l'utilisateur Sarah
INSERT INTO cart (id_user, is_active) VALUES (2, true);

-- Ajout d'un bouquet au panier de Sarah
INSERT INTO cart_items (id_cart, id_flower, quantity) VALUES (1, 1, 2);

-- Ajout aux favoris
INSERT INTO favorites (id_user, id_flower) VALUES (2, 1);

-- Le bouquet ID 1 contient 10 Tulipes roses
INSERT INTO product_flowers (id_flower, id_flower_type, quantity, id_color) 
VALUES (1, 2, 10, 2);

INSERT INTO orders (id_user, total_price) VALUES (2, 4800.00);

INSERT INTO order_info (id_order, id_user, phone, wilaya, communes, address, customer_name) 
VALUES (1, 2, '0551668088', 'Alger', 'Bab Ezzouar', 'Cite Smail Yefsah', 'Sarah');