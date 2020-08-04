class ApplicationController < ActionController::Base

  before_action :configure_permitted_parameters, if: :devise_controller?

  def current_user_admin?
    # This uses the current_user method from the Devise Gem.  Is that necessary?  Yes.  A check to see that there
    # is a current user is required before checking to see if the current_user is an admin.
    current_user && current_user.admin?
  end

  # This makes the controller method available to to the helpers (views).
  helper_method :current_user_admin?

  def require_admin
    unless current_user_admin?
      redirect_to root_url, alert: "Unauthorized access!"
    end
  end

  def require_signin
    unless current_user
      redirect_to new_user_session_url, alert: "Please sign in first!"
    end
  end

  protected

  def configure_permitted_parameters
    devise_parameter_sanitizer.permit(:sign_up) do |u|
      u.permit :username, :email, :password, :password_confirmation, :first_name, :last_name,
               :dateOfBirth, :billing_address_line_one, :billing_address_line_two, :billing_city,
               :billing_state, :billing_zip, :mailing_address_line_one, :mailing_address_line_two, :mailing_city,
               :mailing_state, :mailing_zip

    end
  end
end
