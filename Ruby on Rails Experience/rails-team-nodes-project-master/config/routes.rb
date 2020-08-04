Rails.application.routes.draw do


  resources :payments
  resources :user
  resources :products do
    resources :questions do
      resources :answers
    end
  end
  devise_for :users

  root to: "page#index"

end
