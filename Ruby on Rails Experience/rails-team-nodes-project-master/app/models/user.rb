class User < ApplicationRecord
  attr_encrypted :cc_number, key: 'This is a key that is 256 bits!!', prefix: 'secret_', suffix: '_crypted'
  attr_encrypted :cvv_num, key: 'This is a key that is 256 bits!!', prefix: 'secret_', suffix: '_crypted'
  attr_encrypted :exp_date, key: 'This is a key that is 256 bits!!', prefix: 'secret_', suffix: '_crypted'

  # Include default devise modules. Others available are:
  # :confirmable, :lockable, :timeoutable, :trackable and :omniauthable
  devise :database_authenticatable, :registerable,
         :recoverable, :rememberable, :validatable

  validates :billing_address_line_one, :mailing_address_line_one, :first_name, :last_name,
            :mailing_city, :mailing_state, :mailing_zip, :billing_city, :billing_state, :billing_zip, presence: {message: "This field is required"}
  validates :email, uniqueness: {message: "This email already has an account associated with it."}

  # Validates 5 and 9 digit zip codes. e.g. 12345, or 12345-1234
  validates :mailing_zip, :billing_zip, format: { with: /^\d{5}(-\d{4})?$/, :multiline => true, message: "Please enter the correct format" }
  # Validates uppercase only two letter US state abbreviations.
  validates :mailing_state, :billing_state, format: { with: /^(?-i:A[LKSZRAEP]|C[AOT]|D[EC]|F[LM]|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEHINOPST]|N[CDEHJMVY]|O[HKR]|P[ARW]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$/, :multiline => true, message: "Please use correct abbreviation"}

end
