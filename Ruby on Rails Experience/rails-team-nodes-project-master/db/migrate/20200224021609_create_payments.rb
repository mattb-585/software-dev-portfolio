class CreatePayments < ActiveRecord::Migration[6.0]
  def change
    create_table :payments do |t|
      t.string :encrypted_cc_number
      t.string :encrypted_exp_date
      t.string :excrypted_cvv_num

      t.timestamps
    end
  end
end
