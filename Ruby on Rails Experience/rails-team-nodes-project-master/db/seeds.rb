# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rails db:seed command (or created alongside the database with db:setup).
#
# Examples:
#
#   movies = Movie.create([{ name: 'Star Wars' }, { name: 'Lord of the Rings' }])
#   Character.create(name: 'Luke', movie: movies.first)



require 'faker'
include Faker



#Seed Product Database w/ 100 Records

Product.destroy_all

100.times do | index |

  new_product = Product.create(

      name: Commerce.product_name,
      description: Commerce.material,
      date_posted: Faker::Date.backward,
      price: Number.decimal(l_digits: 2, r_digits: 2),
      shipping_weight: Number.decimal(l_digits: 2, r_digits: 2),
      quantity_available: Number.number(digits: 3),
  )

end

ProductImage.destroy_all
Product.all.each do |item|
  4.times do
    new_product_image = ProductImage.create(
        image: LoremFlickr.image(size: "1400x600"),
        product_id: item.id
    )
  end
end
