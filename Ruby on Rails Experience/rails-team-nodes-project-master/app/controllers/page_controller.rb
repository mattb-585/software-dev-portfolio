class PageController < ApplicationController
  def index
    @products = Product.all
    @product_images = ProductImage.all
  end
end