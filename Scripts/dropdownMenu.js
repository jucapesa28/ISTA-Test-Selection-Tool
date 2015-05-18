var columns = new Array("cell1", "cell2", "cell3", "cell4", "cell5", "cell6", "cell7", "cell8",
            "cell9", "cell10", "cell11", "cell12", "cell13", "cell14", "cell15", "cell16", "cell17", "cell18",
            "cell19", "cell20", "cell21", "cell22", "cell23", "cell24", "cell25", "cell26", "cell27", "cell28",
            "cell29", "cell30", "cell31", "cell32");

function enableDropdown() {
    if (document.getElementById("DistributionTypeName").disabled == true) {
        document.getElementById("DistributionTypeName").disabled = false;
    }
    else {
        var dt = document.getElementById("DistributionTypeName");
        dt.selectedIndex = 0;
        clearTable();
    }
    
}

function validateCountry() {
    country = document.getElementById("CountryTxt");
    countrySelected = country.options[country.selectedIndex].value;

    if (countrySelected != "United States") {
        document.getElementById("StateTxt").disabled = true;
        document.getElementById("ZipCodeTxt").disabled = true;
    }
    else {
        document.getElementById("StateTxt").disabled = false;
        document.getElementById("ZipCodeTxt").disabled = false;
    }
}

function clearTable() {

    for (var i = 0; i < columns.length; i++) {
        document.getElementById(columns[i]).style.background = "#f2f2f2";
        document.getElementById(columns[i]).style.border = "1px solid #000";
    }
}

function focusCell(cellID) {
    document.getElementById(cellID).style.background = "#ffffd6";
    document.getElementById(cellID).style.border = "4px navy ridge";
}

function displayProtocols() {

    clearTable();

    var testBox, protocols, objvalue1, objvalue2, dropdownValue2, dropdown2;
    var obj = document.getElementById('PackageTypeName');
    dropdown2 = document.getElementById("DistributionTypeName");
    dropdownValue2 = dropdown2.options[dropdown2.selectedIndex].value;
    objvalue1 = obj.options[obj.selectedIndex].value;

    if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "Any") {
        focusCell("cell1");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "Specialized Furniture") {
        focusCell("cell5");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "Parcel Delivery") {
        focusCell("cell9");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "Less Than Truckload Delivery") {
        focusCell("cell13");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "Distribution Center to Retail") {
        focusCell("cell17");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "ISTA Member Tests") {
        focusCell("cell21");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "European Consumer Goods") {
        focusCell("cell25");
    }
    else if (objvalue1 == "Individual Pkg up to 150 lbs" && dropdownValue2 == "Thermal Testing of Insulated Shipping Containers") {
        focusCell("cell29");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "Any") {
        focusCell("cell2");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "Specialized Furniture") {
        focusCell("cell6");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "Parcel Delivery") {
        focusCell("cell10");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "Less Than Truckload Delivery") {
        focusCell("cell14");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "Distribution Center to Retail") {
        focusCell("cell18");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "ISTA Member Tests") {
        focusCell("cell22");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "European Consumer Goods") {
        focusCell("cell26");
    }
    else if (objvalue1 == "Individual Pkg over 150 lbs" && dropdownValue2 == "Thermal Testing of Insulated Shipping Containers") {
        focusCell("cell30");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "Any") {
        focusCell("cell3");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "Specialized Furniture") {
        focusCell("cell7");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "Parcel Delivery") {
        focusCell("cell11");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "Less Than Truckload Delivery") {
        focusCell("cell15");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "Distribution Center to Retail") {
        focusCell("cell19");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "ISTA Member Tests") {
        focusCell("cell23");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "European Consumer Goods") {
        focusCell("cell27");
    }
    else if (objvalue1 == "Unitized" && dropdownValue2 == "Thermal Testing of Insulated Shipping Containers") {
        focusCell("cell31");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "Any") {
        focusCell("cell4");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "Specialized Furniture") {
        focusCell("cell8");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "Parcel Delivery") {
        focusCell("cell12");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "Less Than Truckload Delivery") {
        focusCell("cell16");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "Distribution Center to Retail") {
        focusCell("cell20");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "ISTA Member Tests") {
        focusCell("cell24");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "European Consumer Goods") {
        focusCell("cell28");
    }
    else if (objvalue1 == "Bulk" && dropdownValue2 == "Thermal Testing of Insulated Shipping Containers") {
        focusCell("cell32");
    }
}  