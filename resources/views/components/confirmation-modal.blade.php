<div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title confirm-modal-title" id="confirmationModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('global.close') }}"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="confirmation_item_id" name="confirmation_item_id" id="confirmation_item_id">
                <div class="operation_status hiddens" id="operation_status"></div>
                <div class="lar hiddens" id="lar"></div>
                <p id="modalDescriptionText"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary ApproveDeclineButton" data-request-action="" data-action-type="">{{ __('global.yes') }}</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('global.nos') }}</button>
            </div>
        </div>
    </div>
</div>