create database if not exists mem_cache;
use mem_cache;

create table if not exists cache_data(
    id int(11) not null primary key auto_increment,
    key_value varchar(60) not null unique,
    image_path varchar(250) not null unique,
    add_date datetime not null default CURRENT_TIMESTAMP
);
create table if not exists polices(
    id int(11) not null primary key auto_increment,
    policy varchar(50) not null
);    
create table if not exists configuration(
    capacity decimal(3,2) not null default 1.0,
    policy_id int(11) not null default 1,
    last_updated datetime not null default CURRENT_TIMESTAMP,
    FOREIGN KEY (policy_id) REFERENCES polices(id)
    );
create table if not exists statistics(
    id int(11) not null primary key auto_increment,
    number_of_items_in_cache int(11) not null default 0,
    total_size decimal(3,2) not null default 0.00,
    miss_rate decimal(5,2) not null default 0,
    hit_rate decimal(5,2) not null default 0,
    date datetime not null default CURRENT_TIMESTAMP,
    number_of_requests_made int(11) not null default 0
);
INSERT INTO polices (id,policy) VALUES(NULL,"random"),
                                     (NULL,"LRU");
INSERT INTO configuration (capacity,policy_id) VALUES(1.00,1);



