
<div class="modal fade" tabindex="-1" id="modalAddQuestion" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Question</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			{{-- <form id="upload-form"> --}}
				@csrf
				<input type="file" name="file" accept=".csv" id="csv_file">
				<button type="button" class="btn btn-primary" id="upload_file_csv" data-save-question-route="{{ route('admin.master.question.store') }}">Upload File CSV</button>
				<p id="uploadMessage"></p>
			{{-- </form> --}}

			<div id="upload-status"></div>
		</div>
		<div class="modal-footer bg-whitesmoke br">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			{{-- <button type="button" class="btn btn-primary" id="save_add_stock" data-add-item-stock-route="{{ route('item.add-stock', ':id') }}">Save changes</button> --}}
		</div>
		</div>
	</div>
</div>