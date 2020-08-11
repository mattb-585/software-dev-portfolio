const sql = require("mssql");
// const dateFormat = require("dateformat");
const { validationResult } = require("express-validator");

function storeController() {
  let errors = [];

  function getShop(req, res) {
    res.render("store/shop", {
      errors,
      token: req.csrfToken(),
    });
  }

  function getSpiceRubs(req, res) {
    errors = [];
    res.render("store/spiceRubs", {
      errors,
      token: req.csrfToken(),
    });
  }

  function getCookbooks(req, res) {
    errors = [];
    res.render("store/cookbooks", {
      errors,
      token: req.csrfToken(),
    });
  }

  function getBakingPlanks(req, res) {
    errors = [];
    res.render("store/bakingPlanks", {
      errors,
      token: req.csrfToken(),
    });
  }

  function getBBQPlanks(req, res) {
    errors = [];
    res.render("store/bbqPlanks", {
      errors,
      token: req.csrfToken(),
    });
  }

  function getNutDriver(req, res) {
    errors = [];
    res.render("store/nutDriver", {
      errors,
      token: req.csrfToken(),
    });
  }

  function postBakingPlanks(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();
    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();
        await request
          .input("productName", sql.NVarChar, req.body.productName)
          .input("price", sql.Float, req.body.price)
          .input("quantity", sql.Float, req.body.quantity)
          .input("productTotal", sql.Float, req.body.quantity * req.body.price)
          .query("INSERT INTO [dbo].[FPCart](ProductName, Price, Quantity, ProductTotal) values(@productName, @price, @quantity, @productTotal);");

        res.redirect("/shop/bakingplanks");
      })();
    } else {
      res.render("store/bakingPlanks", {
        errors,
        token: req.csrfToken(),
      });
    }
  }

  function postSpiceRubs(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();
    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();
        await request
          .input("productName", sql.NVarChar, req.body.productName)
          .input("price", sql.Float, req.body.price)
          .input("quantity", sql.Float, req.body.quantity)
          .input("productTotal", sql.Float, req.body.quantity * req.body.price)
          .query("INSERT INTO [dbo].[FPCart](ProductName, Price, Quantity, ProductTotal) values(@productName, @price, @quantity, @productTotal);");

        res.redirect("/shop/spicerubs");
      })();
    } else {
      res.render("store/spiceRubs", {
        errors,
        token: req.csrfToken(),
      });
    }
  }

  function postBBQPlanks(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();
    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();
        await request
          .input("productName", sql.NVarChar, req.body.productName)
          .input("price", sql.Float, req.body.price)
          .input("quantity", sql.Float, req.body.quantity)
          .input("productTotal", sql.Float, req.body.quantity * req.body.price)
          .query("INSERT INTO [dbo].[FPCart](ProductName, Price, Quantity, ProductTotal) values(@productName, @price, @quantity, @productTotal);");

        res.redirect("/shop/bbqplanks");
      })();
    } else {
      res.render("store/bbqPlanks", {
        errors,
        token: req.csrfToken(),
      });
    }
  }

  function postCookbooks(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();
    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();
        await request
          .input("productName", sql.NVarChar, req.body.productName)
          .input("price", sql.Float, req.body.price)
          .input("quantity", sql.Float, req.body.quantity)
          .input("productTotal", sql.Float, req.body.quantity * req.body.price)
          .query("INSERT INTO [dbo].[FPCart](ProductName, Price, Quantity, ProductTotal) values(@productName, @price, @quantity, @productTotal);");

        res.redirect("/shop/cookbooks");
      })();
    } else {
      res.render("store/cookbooks", {
        errors,
        token: req.csrfToken(),
      });
    }
  }

  function postNutdriver(req, res) {
    const validatorErrors = validationResult(req);
    errors = validatorErrors.array();
    if (errors.length === 0) {
      (async () => {
        const request = new sql.Request();
        await request
          .input("productName", sql.NVarChar, req.body.productName)
          .input("price", sql.Float, req.body.price)
          .input("quantity", sql.Float, req.body.quantity)
          .input("productTotal", sql.Float, req.body.quantity * req.body.price)
          .query("INSERT INTO [dbo].[FPCart](ProductName, Price, Quantity, ProductTotal) values(@productName, @price, @quantity, @productTotal);");

        res.redirect("/shop/nutDriver");
      })();
    } else {
      res.render("store/nutdriver", {
        errors,
        token: req.csrfToken(),
      });
    }
  }

  return {
    getShop,
    getSpiceRubs,
    getCookbooks,
    getBakingPlanks,
    getBBQPlanks,
    getNutDriver,
    postBakingPlanks,
    postSpiceRubs,
    postBBQPlanks,
    postCookbooks,
    postNutdriver,
  };
}

module.exports = storeController;
