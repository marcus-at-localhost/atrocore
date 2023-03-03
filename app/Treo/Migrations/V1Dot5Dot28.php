<?php
/*
 * This file is part of EspoCRM and/or AtroCore.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2019 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: http://www.espocrm.com
 *
 * AtroCore is EspoCRM-based Open Source application.
 * Copyright (C) 2020 AtroCore UG (haftungsbeschränkt).
 *
 * AtroCore as well as EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * AtroCore as well as EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word
 * and "AtroCore" word.
 */

declare(strict_types=1);

namespace Treo\Migrations;

use Treo\Core\Migration\Base;

class V1Dot5Dot28 extends Base
{
    public function up(): void
    {
        $this->getPDO()->exec("CREATE INDEX IDX_STATUS ON queue_item (status, deleted)");
        $this->getPDO()->exec("CREATE INDEX IDX_SORT_ORDER ON queue_item (sort_order, deleted)");

        $this->getPDO()->exec("DROP INDEX IDX_NUMBER ON notification");
        $this->getPDO()->exec("CREATE INDEX IDX_READ ON notification (`read`, deleted)");
        $this->getPDO()->exec("CREATE INDEX IDX_NUMBER ON notification (number, deleted)");
    }

    public function down(): void
    {
        $this->getPDO()->exec("DROP INDEX IDX_STATUS ON queue_item");
        $this->getPDO()->exec("DROP INDEX IDX_SORT_ORDER ON queue_item");

        $this->getPDO()->exec("DROP INDEX IDX_READ ON notification");
        $this->getPDO()->exec("DROP INDEX IDX_NUMBER ON notification");
        $this->getPDO()->exec("CREATE INDEX IDX_NUMBER ON notification (number)");
    }
}