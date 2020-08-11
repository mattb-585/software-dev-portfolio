const sql = require("mssql");
const { validationResult } = require("express-validator");
// const dateFormat = require("dateformat");

function cartController() {
  let errors = [];

  async function getCartData() {
    const request = new sql.Request();
    const cartItems = [];

    const result = await request.query("select * from dbo.FPCart");

    result.recordset.forEach((_cartItem) => {
      const cartItem = {
        id: _cartItem.Id,
        name: _cartItem.ProductName,
        price: _cartItem.Price,
        quantity: _cartItem.Quantity,
        total: _cartItem.ProductTotal,
      };

      cartItems.push(cartItem);
    });
    return cartItems;
  }

  async function getSubtotal() {
    const request = new sql.Request();
    let subTotal = 0;

    const result = await request.query("select * from dbo.FPCart");

    result.recordset.forEach((_cartItem) => {
      subTotal += _cartItem.ProductTotal;
    });
    return subTotal;
  }

  async function getBillingAddressData() {
    const request = new sql.Request();
    const latestBillingAddress = [];

    const result = await request.query("select top 1 * from dbo.FPBillingAddress order by Id desc");

    result.recordset.forEach((_address) => {
      const address = {
        id: _address.Id,
        firstName: _address.FirstName,
        lastName: _address.LastName,
        address: _address.Address,
        addressTwo: _address.AddressTwo,
        city: _address.City,
        state: _address.State,
        zip: _address.Zip,
        phone: _address.Phone,
        email: _address.Email,
      };

      latestBillingAddress.push(address);
    });
    return latestBillingAddress[0];
  }

  async function getShippingAddressData() {
    const request = new sql.Request();
    const latestShippingAddress = [];

    const result = await request.query("select top 1 * from dbo.FPShippingAddress order by Id desc");

    result.recordset.forEach((_address) => {
      const address = {
        id: _address.Id,
        firstName: _address.FirstName,
        lastName: _address.LastName,
        address: _address.Address,
        addressTwo: _address.AddressTwo,
        city: _address.City,
        state: _address.State,
        zip: _address.Zip,
        phone: _address.Phone,
        email: _address.Email,
        comments: _address.Comments
      };

      latestShippingAddress.push(address);
    });
    return latestShippingAddress[0];
  }

  async function getPaymentData() {
    const request = new sql.Request();
    const currentPayment = [];

    const result = await request.query("select top 1 * from dbo.FPPayment order by Id desc");

    result.recordset.forEach((_payment) => {
      const payment = {
        id: _payment.Id,
        shippingCost: _payment.ShippingCost,
        cardType: _payment.CardType,
        cardNumber: _payment.CardNumber,
        expirationMonth: _payment.ExpirationMonth,
        expirationYear: _payment.ExpirationYear,
        subtotal: _payment.Subtotal,
        total: _payment.Total,
      };

      currentPayment.push(payment);
    });
    return currentPayment[0];
  }

  function getCart(req, res) {
    (async () => {
      errors = [];
      const cartItems = await getCartData();
      const subTotal = await getSubtotal();
      res.render("cart/cart", {
        cartItems,
        subTotal,
        errors,
        token: req.csrfToken(),
      });
    })();
  }

  function getCheckout(req, res) {
    (async () => {
      errors = [];
      const cartItems = await getCartData();
      const subTotal = await getSubtotal();
      res.render("cart/checkout", {
        cartItems,
        subTotal,
        errors,
        token: req.csrfToken(),
      });
    })();
  }

  function getReview(req, res) {
    (async () => {
      errors = [];
      const cartItems = await getCartData();
      const subTotal = await getSubtotal();
      const billingAddress = await getBillingAddressData();
      const shippingAddress = await getShippingAddressData();
      const currentPayment = await getPaymentData();
      res.render("cart/review", {
        cartItems,
        subTotal,
        billingAddress,
        shippingAddress,
        currentPayment,
        errors,
        token: req.csrfToken(),
      });
    })();
  }

  function getReceipt(req, res) {
    (async () => {
      const cartItems = await getCartData();
      const subTotal = await getSubtotal();
      const billingAddress = await getBillingAddressData();
      const shippingAddress = await getShippingAddressData();
      const currentPayment = await getPaymentData();
      res.render("cart/receipt", {
        cartItems,
        subTotal,
        billingAddress,
        shippingAddress,
        currentPayment,
      });
    })();
  }

  function postAddress(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();

    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();
        const sameAsBilling = Boolean(req.body.sameAsBilling);
        await request
          .input("firstName", sql.NVarChar, req.body.billingFirstName)
          .input("lastName", sql.NVarChar, req.body.billingLastName)
          .input("address", sql.NVarChar, req.body.billingAddress)
          .input("addressTwo", sql.NVarChar, req.body.billingAddressTwo)
          .input("city", sql.NVarChar, req.body.billingCity)
          .input("state", sql.NVarChar, req.body.billingState)
          .input("zip", sql.NVarChar, req.body.billingZip)
          .input("phone", sql.NVarChar, req.body.billingPhone)
          .input("email", sql.NVarChar, req.body.billingEmail)
          .query("INSERT INTO [dbo].[FPBillingAddress](FirstName, LastName, Address, AddressTwo, City, State, Zip, Phone, Email) values(@firstName, @lastName, @address, @addressTwo, @city, @state, @zip, @phone, @email);");

        if (sameAsBilling === true) {
          await request
            .input("firstNameShipping", sql.NVarChar, req.body.billingFirstName)
            .input("lastNameShipping", sql.NVarChar, req.body.billingLastName)
            .input("addressShipping", sql.NVarChar, req.body.billingAddress)
            .input("addressTwoShipping", sql.NVarChar, req.body.billingAddressTwo)
            .input("cityShipping", sql.NVarChar, req.body.billingCity)
            .input("stateShipping", sql.NVarChar, req.body.billingState)
            .input("zipShipping", sql.NVarChar, req.body.billingZip)
            .input("phoneShipping", sql.NVarChar, req.body.billingPhone)
            .input("emailShipping", sql.NVarChar, req.body.billingEmail)
            .input("comments", sql.NVarChar, req.body.comments)
            .query("INSERT INTO [dbo].[FPShippingAddress](FirstName, LastName, Address, AddressTwo, City, State, Zip, Phone, Email, Comments) values(@firstNameShipping, @lastNameShipping, @addressShipping, @addressTwoShipping, @cityShipping, @stateShipping, @zipShipping, @phoneShipping, @emailShipping, @comments);");
        } else {
          await request
            .input("firstNameShipping", sql.NVarChar, req.body.shippingFirstName)
            .input("lastNameShipping", sql.NVarChar, req.body.shippingLastName)
            .input("addressShipping", sql.NVarChar, req.body.shippingAddress)
            .input("addressTwoShipping", sql.NVarChar, req.body.shippingAddressTwo)
            .input("cityShipping", sql.NVarChar, req.body.shippingCity)
            .input("stateShipping", sql.NVarChar, req.body.shippingState)
            .input("zipShipping", sql.NVarChar, req.body.shippingZip)
            .input("phoneShipping", sql.NVarChar, req.body.shippingPhone)
            .input("emailShipping", sql.NVarChar, req.body.shippingEmail)
            .input("comments", sql.NVarChar, req.body.comments)
            .query("INSERT INTO [dbo].[FPShippingAddress](FirstName, LastName, Address, AddressTwo, City, State, Zip, Phone, Email, Comments) values(@firstNameShipping, @lastNameShipping, @addressShipping, @addressTwoShipping, @cityShipping, @stateShipping, @zipShipping, @phoneShipping, @emailShipping, @comments);");
        }

        await request
          .input("subtotal", sql.Float, req.body.subtotalPayment)
          .input("total", sql.Float, parseFloat(req.body.subtotalPayment) + 3.00)
          .query("INSERT INTO [dbo].[FPPayment](Subtotal, ShippingCost, Total) values(@subtotal, 3.00, @total);");

        res.redirect("/cart/review");
      })();
    } else {
      (async () => {
        const cartItems = await getCartData();
        const subTotal = await getSubtotal();
        res.render("cart/checkout", {
          billingFirstName: req.body.billingFirstName,
          billingLastName: req.body.billingLastName,
          billingAddress: req.body.billingAddress,
          billingAddressTwo: req.body.billingAddressTwo,
          billingCity: req.body.billingCity,
          billingState: req.body.billingState,
          billingZip: req.body.billingZip,
          billingPhone: req.body.billingPhone,
          billingEmail: req.body.billingEmail,
          shippingFirstName: req.body.shippingFirstName,
          shippingLastName: req.body.shippingLastName,
          shippingAddress: req.body.shippingAddress,
          shippingAddressTwo: req.body.shippingAddressTwo,
          shippingCity: req.body.shippingCity,
          shippingState: req.body.shippingState,
          shippingZip: req.body.shippingZip,
          shippingPhone: req.body.shippingPhone,
          shippingEmail: req.body.shippingEmail,
          comments: req.body.comments,
          cartItems,
          subTotal,
          errors,
          token: req.csrfToken(),
        });
      })();
    }
  }

  function putUpdateQuantity(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();

    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();

        await request
          .input("itemId", sql.Int, req.params.id)
          .input("quantityUpdate", sql.Float, req.body.quantityUpdate)
          .input("productTotal", sql.Float, req.body.quantityUpdate * req.body.price)
          .query(
            "update dbo.FPCart set Quantity = @quantityUpdate, ProductTotal = @productTotal where Id=@itemId"
          );
        res.redirect("/cart");
      })();
    } else {
      (async () => {
        const cartItems = await getCartData();
        const subTotal = await getSubtotal();
        res.render("cart/cart", {
          cartItems,
          subTotal,
          errors,
          token: req.csrfToken(),
        });
      })();
    }
  }

  function putUpdateTotal(req, res) {
    (async () => {
      const request = new sql.Request();

      await request
        .input("paymentId", sql.Int, req.params.id)
        .input("subtotal", sql.Float, req.body.subtotal)
        .input("shippingUpdate", sql.Float, req.body.shippingOptions)
        .input("total", sql.Float, parseFloat(req.body.subtotal) + parseFloat(req.body.shippingOptions))
        .query(
          "update dbo.FPPayment set ShippingCost = @shippingUpdate, Total = @total where Id=@paymentId"
        );
      res.redirect("/cart/review");
    })();
  }

  function putUpdateCardInformation(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();

    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();

        await request
          .input("paymentId", sql.Int, req.params.id)
          .input("cardType", sql.NVarChar, req.body.cardType)
          .input("cardNumber", sql.NVarChar, req.body.cardNumber)
          .input("expirationMonth", sql.NVarChar, req.body.cardMonth)
          .input("expirationYear", sql.NVarChar, req.body.cardYear)
          .query(
            "update dbo.FPPayment set CardType = @cardType, CardNumber = @cardNumber, ExpirationMonth = @expirationMonth, ExpirationYear = @expirationYear where Id=@paymentId"
          );
        res.redirect("/cart/receipt");
      })();
    } else {
      (async () => {
        const cartItems = await getCartData();
        const subTotal = await getSubtotal();
        const billingAddress = await getBillingAddressData();
        const shippingAddress = await getShippingAddressData();
        const currentPayment = await getPaymentData();
        res.render("cart/review", {
          cartItems,
          subTotal,
          billingAddress,
          shippingAddress,
          currentPayment,
          errors,
          token: req.csrfToken(),
        });
      })();
    }
  }

  function deleteCartItem(req, res) {
    (async () => {
      const request = new sql.Request();

      await request
        .input("itemId", sql.Int, req.params.id)
        .query(
          "delete from dbo.FPCart where Id=@itemId"
        );
      res.redirect("back");
    })();
  }

  return {
    getCart,
    getCheckout,
    getReview,
    getReceipt,
    postAddress,
    putUpdateQuantity,
    putUpdateTotal,
    putUpdateCardInformation,
    deleteCartItem,
  };
}

module.exports = cartController;
