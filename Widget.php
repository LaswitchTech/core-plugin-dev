<!-- ======= Dev ======= -->
<?php if($this->Auth->isAuthorized('Developer',1)): ?>
    <div id="devWidget" class="nav-item dropdown">
        <button class="nav-link text-decoration-none py-2 animate-pulse-hover" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            <i class="fs-4 bi bi-tools" style="height: 2.25rem !important;width: 1.5rem !important"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="min-width:400px;max-width:500px">
            <li>
                <h5 class="py-2 px-3 m-0 cursor-default d-flex justify-content-center align-items-center">
                    <span><?= $this->Locale->get('Developer Tools') ?></span>
                </h5>
            </li>
            <li><hr class="dropdown-divider mt-0"></li>
            <?php foreach($this->Builder->menu('developer') as $route => $nav): ?>
                <li>
                    <a class="dropdown-item" href="<?= $nav['link'] ?>">
                        <i class="bi bi-<?= $nav['icon'] ?> me-1"></i>
                        <span><?= $this->Locale->get($nav['label']); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php if(count($this->Builder->menu('developer')) > 0): ?>
                <li><hr class="dropdown-divider"></li>
            <?php endif; ?>
            <li class="dropdown-submenu dropstart">
                <button type="button" class="dropdown-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-gear me-1"></i>
                    <span><?= $this->Locale->get('Maintenance') ?></span>
                    <?php if($this->Config->get('application','maintenance')): ?>
                        <span class="badge rounded-pill ms-1 text-bg-success" data-label="maintenance"><?= $this->Locale->get('On'); ?></span>
                    <?php else: ?>
                        <span class="badge rounded-pill ms-1 text-bg-danger" data-label="maintenance"><?= $this->Locale->get('Off'); ?></span>
                    <?php endif; ?>
                </button>
                <ul class="dropdown-menu" style="min-width:350px;max-width:500px;">
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="maintenance" data-dev-value="on">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <span><?= $this->Locale->get('On'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="maintenance" data-dev-value="off">
                            <i class="bi bi-x-circle text-danger me-1"></i>
                            <span><?= $this->Locale->get('Off'); ?></span>
                        </button>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu dropstart">
                <button type="button" class="dropdown-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-tools me-1"></i>
                    <span><?= $this->Locale->get('Development') ?></span>
                    <?php if($this->Config->get('application','development')): ?>
                        <span class="badge rounded-pill ms-1 text-bg-success" data-label="development"><?= $this->Locale->get('On'); ?></span>
                    <?php else: ?>
                        <span class="badge rounded-pill ms-1 text-bg-danger" data-label="development"><?= $this->Locale->get('Off'); ?></span>
                    <?php endif; ?>
                </button>
                <ul class="dropdown-menu" style="min-width:350px;max-width:500px;">
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="development" data-dev-value="on">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <span><?= $this->Locale->get('On'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="development" data-dev-value="off">
                            <i class="bi bi-x-circle text-danger me-1"></i>
                            <span><?= $this->Locale->get('Off'); ?></span>
                        </button>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu dropstart">
                <button type="button" class="dropdown-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-wrench-adjustable-circle me-1"></i>
                    <span><?= $this->Locale->get('Installer') ?></span>
                    <?php if(!$this->Config->get('application','installed')): ?>
                        <span class="badge rounded-pill ms-1 text-bg-success" data-label="installer"><?= $this->Locale->get('On'); ?></span>
                    <?php else: ?>
                        <span class="badge rounded-pill ms-1 text-bg-danger" data-label="installer"><?= $this->Locale->get('Off'); ?></span>
                    <?php endif; ?>
                </button>
                <ul class="dropdown-menu" style="min-width:350px;max-width:500px;">
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="installer" data-dev-value="off">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <span><?= $this->Locale->get('On'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="installer" data-dev-value="on">
                            <i class="bi bi-x-circle text-danger me-1"></i>
                            <span><?= $this->Locale->get('Off'); ?></span>
                        </button>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu dropstart">
                <button type="button" class="dropdown-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-journal-text me-1"></i>
                    <span><?= $this->Locale->get('Logger') ?></span>
                    <?php $color = "secondary"; $label = "Disabled"; ?>
                    <?php switch($this->Config->get('log','level')):
                        case 0: $color = "secondary"; $label = "Disabled"; break;
                        case 1: $color = "danger"; $label = "Error"; break;
                        case 2: $color = "warning"; $label = "Warning"; break;
                        case 3: $color = "success"; $label = "Success"; break;
                        case 4: $color = "info"; $label = "Info"; break;
                        default: $color = "dark"; $label = "Debug"; break;
                    endswitch; ?>
                    <span class="badge rounded-pill ms-1 text-bg-<?= $color ?>" data-label="logger"><?= $this->Locale->get($label); ?></span>
                </button>
                <ul class="dropdown-menu" style="min-width:350px;max-width:500px;">
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="logger" data-dev-value="0">
                            <i class="bi bi-x-circle text-secondary me-1"></i>
                            <span><?= $this->Locale->get('Disable'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="logger" data-dev-value="1">
                            <i class="bi bi-exclamation-triangle text-danger me-1"></i>
                            <span><?= $this->Locale->get('Error'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="logger" data-dev-value="2">
                            <i class="bi bi-exclamation-circle text-warning me-1"></i>
                            <span><?= $this->Locale->get('Warning'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="logger" data-dev-value="3">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <span><?= $this->Locale->get('Success'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="logger" data-dev-value="4">
                            <i class="bi bi-info-circle text-info me-1"></i>
                            <span><?= $this->Locale->get('Info'); ?></span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-dev-action="logger" data-dev-value="5">
                            <i class="bi bi-bug text-dark me-1"></i>
                            <span><?= $this->Locale->get('Debug'); ?></span>
                        </button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <script>
        $(document).ready(function(){
            const widget = $('#devWidget');
            const actions = widget.find('[data-dev-action]');

            // Loop through each action
            actions.each(function() {
                const button = $(this);
                const action = button.data('dev-action');
                const value = button.data('dev-value');

                // Add click event listener
                button.on('click', function() {
                    switch(action){
                        case 'development':
                            // Ajax Request
                            $.ajax({
                                url: '/api/dev/'+value,
                                type: 'GET',dataType: 'json',
                                success: function(response) {
                                    // Update the badge text
                                    switch(value){
                                        case 'on':
                                            widget.find('[data-label="development"]').removeClass('text-bg-danger').addClass('text-bg-success');
                                            widget.find('[data-label="development"]').text('<?= $this->Locale->get('On'); ?>');
                                            break;
                                        case 'off':
                                            widget.find('[data-label="development"]').removeClass('text-bg-success').addClass('text-bg-danger');
                                            widget.find('[data-label="development"]').text('<?= $this->Locale->get('Off'); ?>');
                                            break;
                                    }
                                    return;
                                }
                            });
                            break;
                        case 'maintenance':
                            // Ajax Request
                            $.ajax({
                                url: '/api/maintenance/'+value,
                                type: 'GET',dataType: 'json',
                                success: function(response) {
                                    // Update the badge text
                                    switch(value){
                                        case 'on':
                                            widget.find('[data-label="maintenance"]').removeClass('text-bg-danger').addClass('text-bg-success');
                                            widget.find('[data-label="maintenance"]').text('<?= $this->Locale->get('On'); ?>');
                                            break;
                                        case 'off':
                                            widget.find('[data-label="maintenance"]').removeClass('text-bg-success').addClass('text-bg-danger');
                                            widget.find('[data-label="maintenance"]').text('<?= $this->Locale->get('Off'); ?>');
                                            break;
                                    }
                                    return;
                                }
                            });
                            break;
                        case 'installer':
                            // Ajax Request
                            $.ajax({
                                url: '/api/installer/'+value,
                                type: 'GET',dataType: 'json',
                                success: function(response) {
                                    // Update the badge text
                                    switch(value){
                                        case 'on':
                                            widget.find('[data-label="installer"]').removeClass('text-bg-success').addClass('text-bg-danger');
                                            widget.find('[data-label="installer"]').text('<?= $this->Locale->get('Off'); ?>');
                                            break;
                                        case 'off':
                                            widget.find('[data-label="installer"]').removeClass('text-bg-danger').addClass('text-bg-success');
                                            widget.find('[data-label="installer"]').text('<?= $this->Locale->get('On'); ?>');
                                            break;
                                    }
                                    return;
                                }
                            });
                            break;
                        case 'logger':
                            // Ajax Request
                            $.ajax({
                                url: '/api/logger/set?level='+value,
                                type: 'GET',dataType: 'json',
                                success: function(response) {
                                    // Update the badge text
                                    widget.find('[data-label="logger"]')
                                        .removeClass('text-bg-secondary')
                                        .removeClass('text-bg-danger')
                                        .removeClass('text-bg-warning')
                                        .removeClass('text-bg-success')
                                        .removeClass('text-bg-info')
                                        .removeClass('text-bg-dark');
                                    switch(value){
                                        case 0:
                                            widget.find('[data-label="logger"]').addClass('text-bg-secondary');
                                            widget.find('[data-label="logger"]').text('<?= $this->Locale->get('Disable'); ?>');
                                            break;
                                        case 1:
                                            widget.find('[data-label="logger"]').addClass('text-bg-danger');
                                            widget.find('[data-label="logger"]').text('<?= $this->Locale->get('Error'); ?>');
                                            break;
                                        case 2:
                                            widget.find('[data-label="logger"]').addClass('text-bg-warning');
                                            widget.find('[data-label="logger"]').text('<?= $this->Locale->get('Warning'); ?>');
                                            break;
                                        case 3:
                                            widget.find('[data-label="logger"]').addClass('text-bg-success');
                                            widget.find('[data-label="logger"]').text('<?= $this->Locale->get('Success'); ?>');
                                            break;
                                        case 4:
                                            widget.find('[data-label="logger"]').addClass('text-bg-info');
                                            widget.find('[data-label="logger"]').text('<?= $this->Locale->get('Info'); ?>');
                                            break;
                                        default:
                                            widget.find('[data-label="logger"]').addClass('text-bg-dark');
                                            widget.find('[data-label="logger"]').text('<?= $this->Locale->get('Debug'); ?>');
                                            break;
                                    }
                                    return;
                                }
                            });
                            break;
                    }
                });
            });
        });
    </script>
<?php endif; ?>
<!-- ======= End Dev ======= -->
