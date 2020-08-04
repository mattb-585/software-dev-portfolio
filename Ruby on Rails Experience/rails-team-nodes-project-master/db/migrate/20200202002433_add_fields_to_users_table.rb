class AddFieldsToUsersTable < ActiveRecord::Migration[6.0]
  def change
    add_column :users, :billing_address_line_one, :string
    add_column :users, :mailing_address_line_one, :string
    add_column :users, :billing_address_line_two, :string
    add_column :users, :billing_city, :string
    add_column :users, :billing_state, :string
    add_column :users, :billing_zip, :string
    add_column :users, :mailing_address_line_two, :string
    add_column :users, :mailing_city, :string
    add_column :users, :mailing_state, :string
    add_column :users, :mailing_zip, :string
    add_column :users, :first_name, :string
    add_column :users, :last_name, :string
    add_column :users, :date_of_birth, :date
  end
end
