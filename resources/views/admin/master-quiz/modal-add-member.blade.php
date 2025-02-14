
<div class="modal fade" tabindex="-1" id="modalAddMember" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Member</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label for="name">Name <span class="text-danger">*</span></label>
				<input type="text" name="name" id="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email <span class="text-danger">*</span></label>
				<input type="email" name="email" id="email" class="form-control">
			</div>
		</div>
		<div class="modal-footer bg-whitesmoke br">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" id="save_member" data-save-member-route="{{ route('admin.master.member.store') }}">Save Member</button>
			{{-- <button type="button" class="btn btn-primary" id="save_add_stock" data-add-item-stock-route="{{ route('item.add-stock', ':id') }}">Save changes</button> --}}
		</div>
		</div>
	</div>
</div>