const express = require("express");
const { check, oneOf } = require("express-validator");

const cartController = require("../controllers/cartController");

const cartRouter = express.Router();

function router() {
  const {
    getCart,
    getCheckout,
    getReview,
    getReceipt,
    postAddress,
    putUpdateQuantity,
    putUpdateTotal,
    putUpdateCardInformation,
    deleteCartItem,
  } = cartController();

  cartRouter.route("/").get(getCart);
  cartRouter.route("/stepone").get(getCart);
  cartRouter.route("/checkout").get(getCheckout);
  cartRouter.route("/steptwo").get(getCheckout);
  cartRouter.route("/review").get(getReview);
  cartRouter.route("/stepthree").get(getReview);
  cartRouter.route("/receipt").get(getReceipt);
  cartRouter.route("/stepfour").get(getReceipt);

  cartRouter.post("/add-address", [
    check("billingFirstName").notEmpty().withMessage("You must enter a first name for the billing address"),
    check("billingLastName").notEmpty().withMessage("You must enter a last name for the billing address"),
    check("billingAddress").notEmpty().withMessage("You must enter a street address for the billing address"),
    check("billingCity").notEmpty().withMessage("You must enter a city for the billing address"),
    check("billingZip").notEmpty().withMessage("You must enter a valid postal code for the billing address"),
    check("billingPhone").isMobilePhone().withMessage("You must enter a valid phone number for the billing address"),
    check("billingEmail").isEmail().withMessage("You must enter a valid e-mail for the billing address"),

    oneOf([
      check("shippingFirstName").notEmpty(),
      check("sameAsBilling").equals("true")
    ], "You must enter a first name for the shipping address"),

    oneOf([
      check("shippingLastName").notEmpty(),
      check("sameAsBilling").equals("true")
    ], "You must enter a last name for the shipping address"),

    oneOf([
      check("shippingAddress").notEmpty(),
      check("sameAsBilling").equals("true")
    ], "You must enter a street address for the shipping address"),

    oneOf([
      check("shippingCity").notEmpty(),
      check("sameAsBilling").equals("true")
    ], "You must enter a city for the shipping address"),

    oneOf([
      check("shippingZip").notEmpty(),
      check("sameAsBilling").equals("true")
    ], "You must enter a valid postal code for the shipping address"),

  ], postAddress);

  cartRouter.post("/update-quantity/:id", [
    check("quantityUpdate").isInt().withMessage("You Must enter a quantity")
  ], putUpdateQuantity);

  cartRouter.route("/update-total/:id").post(putUpdateTotal);

  // cartRouter.route("/update-card/:id").post(putUpdateCardInformation);

  cartRouter.post("/update-card/:id", [
    check("cardNumber").notEmpty().withMessage("You Must enter a valid credit card number")
  ], putUpdateCardInformation);

  cartRouter.route("/delete/:id").get(deleteCartItem);

  return cartRouter;
}

module.exports = router;
