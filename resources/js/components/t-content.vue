<template>
    <div class="content">
        <div class="content__action-description">Для продолжения введите свой номер телефона</div>
        <div class="content__form">
            <input class="content__form__input" />
            <button class="content__form__button">ОК</button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.content {
    flex: 1;
    display: flex;
    align-items: center;
    flex-direction: column;
    width: 78.125%;

    &__action-description {
        font-size: 15px;
    }

    &__form {
        margin-top: 2rem;
        display: flex;
        width: 100%;

        &__input {
            width: 100%;
            min-height: 2em;
            max-width: 250px;
            border: none;
            border-radius: 3px;
            padding-left: 5px;
            margin: 1px 0;
            outline: none;
            background: #ffffff;
            flex: 1;
            height: 30px;
            position: relative;
            padding-bottom: 0;
        }
    }
}
</style>
