var width = parseFloat(prompt("Enter Width: "));
var height = parseFloat(prompt("Enter Height: "));
var area = width * height;

if (area < 400) {
  var fee = 25;
} else if (area > 400 && area < 600) {
  var fee = 35;
} else if (area > 600) {
  var fee = 50;
} else {
  prompt("Invalid input");
}
var totalfee = fee * 20;

alert("Total mowing fee for a " + area + " square feet lawn is RM" + totalfee);
