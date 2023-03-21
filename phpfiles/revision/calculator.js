function calculate(operation) {
  var num1 = parseFloat(document.getElementById("firstnum").value);
  var num2 = parseFloat(document.getElementById("secondnum").value);
  var result = 0;
  if (operation == "+") {
    result = num1 + num2;
  } else if (operation == "-") {
    result = num1 - num2;
  } else if (operation == "*") {
    result = num1 * num2;
  } else if (operation == "/") {
    result = num1 / num2;
  }
  alert("The result is: " + result);
}
