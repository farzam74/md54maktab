<?php
// TODO: CHECK 4 consequtive years (2021-2020-2019-2018)
// MohammadMahdi Taheri - Class Practice No-01 assigned at 20/03/1400
function convertGregorianToJalali(string $gr_date) { //  2021/06/10 => 1400/03/20
    $gr_year = substr($gr_date,0,4);
    $gr_month = substr($gr_date, 5,2);
    $gr_day = substr($gr_date, 8,2);
    $j_year = $j_month = $j_day = null;

    if (((int)$gr_month < 3) ||
        ($gr_month == "03" && (int) $gr_year % 4 != 0 && (int) $gr_day < 21) ||
        ($gr_month == "03" && (int) $gr_year % 4 == 0 && (int) $gr_day < 20)) {
            $j_year = $gr_year - 622;
    }
    elseif ((int) $gr_month >= 4 ||
            ($gr_month == "03" && (int) $gr_year % 4 == 0 && (int) $gr_day >= 20) ||
            ($gr_month == "03" && (int) $gr_year % 4 != 0 && (int) $gr_day >= 21)) {
            $j_year = $gr_year - 621;
    }
    if ((int) $gr_year % 4 != 0) { // for years like 2021, 2019, 2018, 2017, 2015, etc
        switch ($gr_month) {
            case "01": // January has 31 days
                if ((int) $gr_day < 20) {
                    $j_month = "10"; // Dey
                    $j_day = (string) ((int) $gr_day + 11);
                }
                else {
                    $j_month = "11"; // Bahman
                    $j_day = (string) ((int) $gr_day - 19);
                }
                break;
            case "02": // February has 28 days
                if ((int) $gr_day < 19) {
                    $j_month = "11"; // Bahman
                    $j_day = (string) ((int) $gr_day + 12);
                }
                else {
                    $j_month = "12"; // Esfand
                    $j_day = (string) ((int) $gr_day - 18);
                }
                break;
            case "03": // March has 31 days
                if ((int) $gr_day < 21) {
                    $j_month = "12"; // Esfand
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "01"; // Farvardin
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;
            case "04": // April has 30 days
                if ((int) $gr_day < 21) {
                    $j_month = "01"; // Farvardin
                    $j_day = (string) ((int) $gr_day + 11);
                }
                else {
                    $j_month = "02"; // Ordibehesht
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;
            case "05": // May has 31 days
                if ((int) $gr_day < 22) {
                    $j_month = "02"; // Ordibehesht
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "03"; // Khordad
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;
            case "06": // June has 30 days
                if ((int) $gr_day < 22) {
                    $j_month = "03"; // Khordad
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "04"; // Tir
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;
            case "07": // July has 31 days
                if ((int) $gr_day < 23) {
                    $j_month = "04"; // Tir
                    $j_day = (string) ((int) $gr_day + 9);
                }
                else {
                    $j_month = "05"; // Mordad
                    $j_day = (string) ((int) $gr_day - 22);
                }
                break;
            case "08": // August has 31 days
                if ((int) $gr_day < 23) {
                    $j_month = "05"; // Mordad
                    $j_day = (string) ((int) $gr_day + 9);
                }
                else {
                    $j_month = "06"; // Shahrivar
                    $j_day = (string) ((int) $gr_day - 22);
                }
                break;
            case "09": // September has 30 days
                if ((int) $gr_day < 23) {
                    $j_month = "06"; // Shahrivar
                    $j_day = (string) ((int) $gr_day + 9);
                }
                else {
                    $j_month = "07"; // Mehr
                    $j_day = (string) ((int) $gr_day - 22);
                }
                break;
            case "10": // October has 31 days
                if ((int) $gr_day < 23) {
                    $j_month = "07"; // Mehr
                    $j_day = (string) ((int) $gr_day + 8);
                }
                else {
                    $j_month = "08"; // Aban
                    $j_day = (string) ((int) $gr_day - 22);
                }
                break;
            case "11": // November has 30 days
                if ((int) $gr_day < 22) {
                    $j_month = "08"; // Aban
                    $j_day = (string) ((int) $gr_day + 9);
                }
                else {
                    $j_month = "09"; // Azar
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;
            case "12": // December has 31 days
                if ((int) $gr_day < 22) {
                    $j_month = "09"; // Azar
                    $j_day = (string) ((int) $gr_day + 9);
                }
                else {
                    $j_month = "10"; // Dey
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;
        }
    }

    else if ((int) $gr_year % 4 == 0) { // for years like 2020, 2016, 2012, etc
        switch ($gr_month) {
            case "01": // January has 31 days
                if ((int) $gr_day < 21) {
                    $j_month = "10"; // Dey
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "11"; // Bahman
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;

            case "02": // February has 28 days
                if ((int) $gr_day < 20) {
                    $j_month = "11"; // Bahman
                    $j_day = (string) ((int) $gr_day + 11);
                }
                else {
                    $j_month = "12"; // Esfand
                    $j_day = (string) ((int) $gr_day - 19);
                }
                break;

            case "03": // March has 31 days
                if ((int) $gr_day < 20) {
                    $j_month = "12"; // Esfand
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "01"; // Farvardin
                    $j_day = (string) ((int) $gr_day - 19);
                }
                break;

            case "04": // April has 30 days
                if ((int) $gr_day < 20) {
                    $j_month = "01"; // Farvardin
                    $j_day = (string) ((int) $gr_day + 12);
                }
                else {
                    $j_month = "02"; // Ordibehesht
                    $j_day = (string) ((int) $gr_day - 19);
                }
                break;

            case "05": // May has 31 days
                if ((int) $gr_day < 21) {
                    $j_month = "02"; // Ordibehesht
                    $j_day = (string) ((int) $gr_day + 11);
                }
                else {
                    $j_month = "03"; // Khordad
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;

            case "06": // June has 30 days
                if ((int) $gr_day < 21) {
                    $j_month = "03"; // Khordad
                    $j_day = (string) ((int) $gr_day + 11);
                }
                else {
                    $j_month = "04"; // Tir
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;

            case "07": // July has 31 days
                if ((int) $gr_day < 22) {
                    $j_month = "04"; // Tir
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "05"; // Mordad
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;

            case "08": // August has 31 days
                if ((int) $gr_day < 22) {
                    $j_month = "05"; // Mordad
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "06"; // Shahrivar
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;

            case "09": // September has 30 days
                if ((int) $gr_day < 22) {
                    $j_month = "06"; // Shahrivar
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "07"; // Mehr
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;

            case "10": // October has 31 days
                if ((int) $gr_day < 22) {
                    $j_month = "07"; // Mehr
                    $j_day = (string) ((int) $gr_day + 9);
                }
                else {
                    $j_month = "08"; // Aban
                    $j_day = (string) ((int) $gr_day - 21);
                }
                break;

            case "11": // November has 30 days
                if ((int) $gr_day < 21) {
                    $j_month = "08"; // Aban
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "09"; // Azar
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;

            case "12": // December has 31 days
                if ((int) $gr_day < 21) {
                    $j_month = "09"; // Azar
                    $j_day = (string) ((int) $gr_day + 10);
                }
                else {
                    $j_month = "10"; // Dey
                    $j_day = (string) ((int) $gr_day - 20);
                }
                break;
        }
    }
    return $j_year . "/" . $j_month . "/" . $j_day;
}
// echo convertGregorianToJalali("2022/02/02"); // test