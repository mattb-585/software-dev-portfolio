class Product < ApplicationRecord

  has_many :product_images, dependent: :destroy
  has_many :questions, dependent: :destroy

  validates :name,
            presence: {message: "Please provide a name"}
  validates :description,
            presence: {message: "Please provide a description"}
  validates :price,
            presence: true,
            length: { minimum: 3 }
  validates :shipping_weight,
            presence: {message: "Please provide a Shipping Weight"},
            length: { minimum: 2 }
  validates :quantity_available,
            presence: {message: "Please provide a Quantity"},
            numericality: {only_integer: true }

end
