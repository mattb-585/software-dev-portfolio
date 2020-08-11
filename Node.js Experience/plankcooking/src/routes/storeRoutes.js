const express = require("express");
const { check } = require("express-validator");

const storeController = require("../controllers/storeController");

const storeRouter = express.Router();

function router() {
  const {
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
  } = storeController();

  storeRouter.route("/").get(getShop);
  storeRouter.route("/spicerubs").get(getSpiceRubs);
  storeRouter.route("/cookbooks").get(getCookbooks);
  storeRouter.route("/bakingplanks").get(getBakingPlanks);
  storeRouter.route("/planks").get(getBakingPlanks);
  storeRouter.route("/bbqplanks").get(getBBQPlanks);
  storeRouter.route("/nutdriver").get(getNutDriver);

  storeRouter.post("/add-bakingplanks", [
    check("quantity").isInt().withMessage("You Must enter a quantity")
  ], postBakingPlanks);

  storeRouter.post("/add-spicerubs", [
    check("quantity").isInt().withMessage("You Must enter a quantity")
  ], postSpiceRubs);

  storeRouter.post("/add-bbqplanks", [
    check("quantity").isInt().withMessage("You Must enter a quantity")
  ], postBBQPlanks);

  storeRouter.post("/add-cookbooks", [
    check("quantity").isInt().withMessage("You Must enter a quantity")
  ], postCookbooks);

  storeRouter.post("/add-nutdriver", [
    check("quantity").isInt().withMessage("You Must enter a quantity")
  ], postNutdriver);

  return storeRouter;
}

module.exports = router;
