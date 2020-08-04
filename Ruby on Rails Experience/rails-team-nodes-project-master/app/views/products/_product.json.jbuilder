json.extract! product, :id, :name, :description, :date_posted, :price, :shipping_weight, :quantity_available, :user_id, :created_at, :updated_at
json.url product_url(product, format: :json)
