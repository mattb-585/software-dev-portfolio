require "application_system_test_case"

class PaymentsTest < ApplicationSystemTestCase
  setup do
    @payment = payments(:one)
  end

  test "visiting the index" do
    visit payments_url
    assert_selector "h1", text: "Payments"
  end

  test "creating a Payment" do
    visit payments_url
    click_on "New Payment"

    fill_in "Encrypted cc number", with: @payment.encrypted_cc_number
    fill_in "Encrypted exp date", with: @payment.encrypted_exp_date
    fill_in "Excrypted cvv num", with: @payment.excrypted_cvv_num
    click_on "Create Payment"

    assert_text "Payment was successfully created"
    click_on "Back"
  end

  test "updating a Payment" do
    visit payments_url
    click_on "Edit", match: :first

    fill_in "Encrypted cc number", with: @payment.encrypted_cc_number
    fill_in "Encrypted exp date", with: @payment.encrypted_exp_date
    fill_in "Excrypted cvv num", with: @payment.excrypted_cvv_num
    click_on "Update Payment"

    assert_text "Payment was successfully updated"
    click_on "Back"
  end

  test "destroying a Payment" do
    visit payments_url
    page.accept_confirm do
      click_on "Destroy", match: :first
    end

    assert_text "Payment was successfully destroyed"
  end
end