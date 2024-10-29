<div class="col-xl-3 text-center text-xl-right ml-auto pr-0">
    <a class="language-btn"
       @if (count((array) LaravelLocalization::getSupportedLanguagesKeys()) > 1) data-toggle="modal"
       data-target="#modalChooseCountry"@endif>
        <img src="{{ asset('images/globe.svg') }}" class="language-image"
             alt="Elysium Network - {{ ucfirst( LaravelLocalization::getSupportedLocales()[ LaravelLocalization::getCurrentLocale() ]['native'] ) }}"
             title="Elysium Network - {{ ucfirst( LaravelLocalization::getSupportedLocales()[ LaravelLocalization::getCurrentLocale() ]['native'] ) }}">
        {{ ucfirst( LaravelLocalization::getSupportedLocales()[ LaravelLocalization::getCurrentLocale() ]['native'] ) }}
    </a>
</div>
@if (count((array) LaravelLocalization::getSupportedLanguagesKeys()) > 1)
    <div class="modal fade" id="modalChooseCountry">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('footer.language-modal.header') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="language-name">
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                               @if ($localeCode == LaravelLocalization::getCurrentLocale()) style="color:black;font-weight:bold;"
                               @else style="color:#0a8bdd" @endif>
                                {{ ucfirst( $properties['native'] ) }}
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-primary btn-color mt-3" data-dismiss="modal"
                            data-title="Close">{{ trans('footer.language-modal.button_close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endif
