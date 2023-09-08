<?php
/**
 * Seed for users
 *
 * Contains the sql string for seeding example users into the database
 *
 * PHP version 8.2
 *
 * @category Database
 * @package  Database
 * @author   Filipe Ferreira <filipeferreira94@gmail.com>
 * @license  MIT License
 * @version  GIT: $ID$
 * @link     placeholder.com
 */


// Employee seed data (IGNORE skips duplicates)

$sql = 'INSERT IGNORE INTO employees (name, phone, email, address, gender) VALUES 
    ("Meade Eyes", "199-367-5897", "meyes0@discovery.com", "Apt 1452", "Female"),
    ("Linus Yurikov", "204-918-8072", "lyurikov1@mapquest.com", "Room 1929", "Male"),
    ("Quintilla Petriello", "641-164-6752", "qpetriello2@google.fr", "PO Box 83855", "Female"),
    ("Ruby Kinchington", "203-738-1664", "rkinchington3@microsoft.com", "Apt 979", "Male"),
    ("Sibby Sheldrick", "738-918-2272", "ssheldrick4@hatena.ne.jp", "PO Box 61421", "Female"),
    ("Esther Tokley", "800-760-4388", "etokley5@unicef.org", "PO Box 32202", "Female"),
    ("Willa Merle", "432-104-1764", "wmerle6@themeforest.net", "Suite 50", "Female"),
    ("Murielle Mattea", "167-335-3443", "mmattea7@deviantart.com", "Suite 71", "Female"),
    ("Goldina Pillington", "638-800-2528", "gpillington8@unesco.org", "Apt 1519", "Female"),
    ("Paloma Rout", "366-775-1196", "prout9@constantcontact.com", "Apt 996", "Female"),
    ("Darill Tuxwell", "209-537-6426", "dtuxwella@home.pl", "Apt 242", "Male"),
    ("Chrysler Rennolds", "633-960-4833", "crennoldsb@salon.com", "PO Box 28342", "Female"),
    ("Ramsey Imbrey", "688-991-9557", "rimbreyc@ifeng.com", "PO Box 53028", "Male"),
    ("Park Cheng", "566-163-3787", "pchengd@fc2.com", "Suite 18", "Male"),
    ("Fayina Christofe", "755-995-6310", "fchristofee@jigsy.com", "Apt 356", "Female"),
    ("Chastity Skynner", "747-770-9238", "cskynnerf@ihg.com", "6th Floor", "Female"),
    ("Corrie Ierland", "764-660-6394", "cierlandg@moonfruit.com", "Room 1894", "Male"),
    ("Wayland Purkess", "363-750-8053", "wpurkessh@virginia.edu", "PO Box 49727", "Male"),
    ("Wilburt Gillow", "776-128-5368", "wgillowi@shinystat.com", "PO Box 83650", "Male")';
