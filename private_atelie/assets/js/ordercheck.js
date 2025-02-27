document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("category");
    const serviceSelect = document.getElementById("service");

    categorySelect.addEventListener("change", function () {
      const categoryId = this.value; // Получаем ID выбранной категории

      // Очищаем текущие опции в поле "услуга"
      serviceSelect.innerHTML = '<option value="" selected disabled>Выберите услугу</option>';

      if (categoryId) {
        // Выполняем AJAX-запрос
        fetch(`/private_atelie/app/controllers/get_services.php?categoryId=${categoryId}`)
          .then((response) => response.json())
          .then((data) => {
            // Заполняем поле "услуга" новыми опциями
            data.forEach((service) => {
              const option = document.createElement("option");
              option.value = service.serviceID; // Подставьте правильное поле ID услуги
              option.textContent = service.service_name; // Подставьте правильное поле имени услуги
              serviceSelect.appendChild(option);
            });
          })
          .catch((error) => {
            console.error("Ошибка загрузки услуг:", error);
          });
      }
    });
  });