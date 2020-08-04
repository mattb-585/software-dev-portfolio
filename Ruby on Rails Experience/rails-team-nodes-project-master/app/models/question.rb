class Question < ApplicationRecord
  belongs_to :product
  has_one :answer, dependent: :destroy

  validates :name, presence: true
  validates :question, length: { minimum: 4 }
end
