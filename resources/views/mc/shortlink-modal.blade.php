<div class="c-modal__header">
    <h3 class="c-modal__title">Изменение ссылки</h3>

    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-close"></i>
    </span>
</div>

<div class="c-modal__body">

    <div class="c-card u-bg-secondary u-p-small u-mb-small">
        <span class="u-text-mute u-text-small">Короткая ссылка</span>
        <p>https://www.kit.team/go/{{ $collection->shortlink }}</p>
    </div>

    <form action="{{ route('mc.seo.shortlink.edit', $collection->id) }}" method="POST">
        {{ csrf_field() }}

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="url">Адрес ссылки</label>

            <textarea name="url" class="c-input" id="url">{{ $collection->url }}</textarea>
            <small class="c-field__message">Данное поле обязательно для заполнения</small>
        </div>

        <button class="c-btn c-btn--success c-btn--fullwidth" type="submit">
            Изменить ссылку
        </button>
    </form>
</div>
