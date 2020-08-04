class Answer < ApplicationRecord
  belongs_to :question

  validates :name, presence: true
  validates :answer, length: { minimum: 4 }
end
