<!-- форма ввода e-mail для аутентификации -->
    <form action="/input" method="post">
    @csrf
      <div>
        <label>
          Введите адрес сайта:    
          <input type="url" required name="url[name]" value="">
        </label>
      </div>
      <input type="submit" value="Отправить">
    </form>
<!-- END -->
