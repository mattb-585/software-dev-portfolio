class CreateProducts < ActiveRecord::Migration[6.0]
  def change
    create_table :products do |t|
      t.string :name
      t.text :description
      t.datetime :date_posted
      t.decimal :price
      t.decimal :shipping_weight
      t.integer :quantity_available
      t.belongs_to :user

      t.timestamps
    end
  end
end
