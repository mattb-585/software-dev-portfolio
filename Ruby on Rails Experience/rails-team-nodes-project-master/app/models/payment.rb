class Payment < ApplicationRecord
  attr_encrypted_options.merge!(:encode => true)
  attr_encrypted :cc_number, :key => ENV["CCKEY"]
  attr_encrypted :exp_date, :key => ENV["EXPKEY"]
  attr_encrypted :cvv_num, :key => ENV["CVVKEY"]
end
