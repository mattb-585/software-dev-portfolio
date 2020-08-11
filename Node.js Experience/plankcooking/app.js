const express = require("express"); // CommonJS Pattern
const chalk = require("chalk");
const debug = require("debug")("app");
const morgan = require("morgan");
const path = require("path");
const bodyParser = require("body-parser");
const sql = require("mssql");
const csurf = require("csurf");
const cookieParser = require("cookie-parser");

const app = express();
const port = process.env.PORT || 5000;

const config = {
  user: "mattbaker",
  password: "2Evfhwtt",
  server: "mattbaker5509.database.windows.net",
  database: "CIS259",
  options: {
    enableArithAbort: false,
  }
};

const csrfMiddleware = csurf({
  cookie: true
});

sql.connect(config).catch((err) => debug(err));

app.use(morgan("dev"));
app.use(express.static(path.join(__dirname, "public")));

app.set("views", path.join(__dirname, "src", "views"));
app.set("view engine", "ejs");

app.use(
  "/css",
  express.static(
    path.join(__dirname, "node_modules", "bootstrap", "dist", "css")
  )
);

app.use(
  "/js",
  express.static(
    path.join(__dirname, "node_modules", "bootstrap", "dist", "js")
  )
);

app.use(
  "/js",
  express.static(
    path.join(__dirname, "node_modules", "popper.js", "dist", "umd")
  )
);

app.use(
  "/js",
  express.static(
    path.join(__dirname, "node_modules", "jquery", "dist")
  )
);

app.use(bodyParser.json());
app.use(
  bodyParser.urlencoded({
    extended: true,
  })
);

app.use(cookieParser());
app.use(csrfMiddleware);

app.get("/", (request, response) => {
  response.render("Index");
});

app.get("/about", (request, response) => {
  response.render("about");
});

app.get("/contact", (request, response) => {
  response.render("contact");
});

app.get("/reviews", (request, response) => {
  response.render("reviews");
});

app.get("/recipes", (request, response) => {
  response.render("recipes");
});

const storeRouter = require("./src/routes/storeRoutes")();

app.use("/shop", storeRouter);

const cartRouter = require("./src/routes/cartRoutes")();

app.use("/cart", cartRouter);

app.listen(port, () => {
  debug(`Listening on port ${chalk.blueBright(port)}`);
});
