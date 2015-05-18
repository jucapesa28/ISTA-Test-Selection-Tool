function getBodyElement() {
    return document.getElementsByTagName('body')[0];
}

function englishDimensions() {
    generateDimensions(" inches", " lbs");
}

function metricDimensions() {
    generateDimensions(" mm", " kg");
}

function generateDimensions(dimensionlbl, weightlbl) {

    var div = document.getElementById("dimensionsForm");

    var fieldSet = document.createElement("fieldset");
    fieldSet.setAttribute("id", "dimensionsFieldset");
    div.appendChild(fieldSet);

    var legend = document.createElement("legend");
    legend.innerHTML = "Package Dimensions/Weight";
    fieldSet.appendChild(legend);

    var table = document.createElement("table");
    table.setAttribute("class", "table-format");
    fieldSet.appendChild(table);

    var tbody = document.createElement("tbody");
    table.appendChild(tbody);

    var tr = document.createElement("tr");
    tbody.appendChild(tr);

    var td = document.createElement("td");
    td.setAttribute("class", "textbox");
    tr.appendChild(td);

    var lengthLabel = document.createElement("label");
    lengthLabel.setAttribute("for", "LengthLabel");
    lengthLabel.innerHTML = "Length ";
    td.appendChild(lengthLabel);

    var lengthInput = document.createElement("input");
    lengthInput.setAttribute("type", "text");
    lengthInput.setAttribute("name", "length");
    lengthInput.setAttribute("id", "length");
    lengthInput.setAttribute("value", "");
    td.appendChild(lengthInput);

    var widthLabel = document.createElement("label");
    widthLabel.setAttribute("for", "widthLabel");
    widthLabel.innerHTML = " Width ";
    td.appendChild(widthLabel);

    var widthInput = document.createElement("input");
    widthInput.setAttribute("type", "text");
    widthInput.setAttribute("name", "width");
    widthInput.setAttribute("id", "width");
    widthInput.setAttribute("value", "");
    td.appendChild(widthInput);

    var heightLabel = document.createElement("label");
    heightLabel.setAttribute("for", "heightLabel");
    heightLabel.innerHTML = " Height ";
    td.appendChild(heightLabel);

    var heightInput = document.createElement("input");
    heightInput.setAttribute("type", "text");
    heightInput.setAttribute("name", "height");
    heightInput.setAttribute("id", "height");
    heightInput.setAttribute("value", "");
    td.appendChild(heightInput);

    var dimensionsLabel = document.createElement("label");
    dimensionsLabel.setAttribute("id", "dimensions");
    dimensionsLabel.innerHTML = dimensionlbl;
    td.appendChild(dimensionsLabel);

    var tr2 = document.createElement("tr");
    tbody.appendChild(tr2);

    var td2 = document.createElement("td");
    td.setAttribute("class", "textbox");
    tr2.appendChild(td2);

    var weightLabel = document.createElement("label");
    weightLabel.setAttribute("for", "weightLabel");
    weightLabel.innerHTML = "Weight ";
    td2.appendChild(weightLabel);

    var weightInput = document.createElement("input");
    weightInput.setAttribute("type", "text");
    weightInput.setAttribute("name", "weight");
    weightInput.setAttribute("id", "weight");
    weightInput.setAttribute("value", "");
    td2.appendChild(weightInput);

    var pckgWeightLabel = document.createElement("label");
    pckgWeightLabel.setAttribute("id", "pckgWeight");
    pckgWeightLabel.innerHTML = weightlbl;
    td2.appendChild(pckgWeightLabel);

    document.getElementById("metrics").disabled = true;
    document.getElementById("english").disabled = true;
    document.getElementById("start-over").disabled = false;
}

function startOver() {
    var div = document.getElementById("dimensionsForm");
    var olddiv = document.getElementById("dimensionsFieldset");
    div.removeChild(olddiv);

    document.getElementById("metrics").disabled = false;
    document.getElementById("english").disabled = false;
    document.getElementById("start-over").disabled = true;
}

function goBack() {
    history.go(-1);
}