class QuestionsController < ApplicationController

  before_action :require_signin

  # before_action :require_admin, only: [:index, :edit, :update, :destroy]


  before_action :set_question, only: [:show, :edit, :update, :destroy]
  before_action :set_product, only: [:create, :new]

  def index
  end

  def show
  end

  def new
    @question = @product.questions.new
  end

  # def edit
  #   @post = Post.find(@comment.post_id)
  #   @content = @comment.content
  # end

  # POST /comments
  # POST /comments.json
  def create
    # @post = Post.find_by!(slug: params[:post_id])
    @question = Question.new(question_params)
    @question.name = current_user
    # This makes the comment sticky if it fails validation.
    session[:question_content] = @question.question

    respond_to do |format|
      if @question.save
        session[:question_content] = nil
        format.html { redirect_to @product, notice: 'Comment was successfully created.' }
        format.json { render :show, status: :created, location: @product }
      else
        format.html { redirect_to @product }
        format.json { render json: @question.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /comments/1
  # PATCH/PUT /comments/1.json
  # def update
  #   @post = Post.find(@comment.post_id)
  #
  #   respond_to do |format|
  #     if @comment.update(comment_params)
  #       format.html { redirect_to @post, notice: 'Comment was successfully updated.' }
  #       format.json { render :show, status: :ok, location: @post }
  #     else
  #       format.html { render :edit }
  #       format.json { render json: @comment.errors, status: :unprocessable_entity }
  #     end
  #   end
  # end

  # DELETE /comments/1
  # DELETE /comments/1.json
  # def destroy
  #   @comment.destroy
  #   respond_to do |format|
  #     format.html { redirect_to comments_url, notice: 'Comment was successfully destroyed.' }
  #     format.json { head :no_content }
  #   end
  # end

  private
  # Use callbacks to share common setup or constraints between actions.
  def set_question
    @question = Question.find(params[:id])
  end

  def set_product
    @product = Product.find(params[:product_id])
  end

  # Never trust parameters from the scary internet, only allow the white list through.
  def question_params
    params.require(:question).permit(:name, :question, :product_id)
  end
end
