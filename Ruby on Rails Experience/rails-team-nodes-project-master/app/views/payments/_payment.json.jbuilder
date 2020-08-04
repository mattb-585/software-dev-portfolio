json.extract! payment, :id, :encrypted_cc_number, :encrypted_exp_date, :excrypted_cvv_num, :created_at, :updated_at
json.url payment_url(payment, format: :json)
