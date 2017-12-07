<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\Behat\Tester\Exception\PendingException;
use Magefix\Fixtures\Registry as FixturesRegistry;
use Magefix\Fixture\Factory\Builder as FixtureBuilder;
use Unic\Pages\Page\Site\Admin\Login as AdminLoginPage;
use Unic\Pages\Page\Site\Admin\CmsWidgetCreationPage as AdminCmsWidgetCreationPage;
use Unic\Pages\Page\Site\Admin\CmsWidgetIndexPage as AdminCmsWidgetIndexPage;
use Data\Providers\Admin as AdminDataProvider;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    const PRODUCT_COUNT = 5;

    use FixturesRegistry;

    /**
     * @var Login
     */
    protected $_adminLoginPage;

    /**
     * @var AdminCmsWidgetCreationPage
     */
    protected $_adminCmsWidgetCreationPage;

    /**
     * @var AdminCmsWidgetCreationPage
     */
    protected $_adminCmsWidgetIndexPage;

     /**
     * @var string
     */
    protected static $_adminUserFixtureId;

    /**
     * @var array
     */
    protected static $_productFixtureIds = [];

    /**
     * @var int
     */
    protected static $_categoryFixtureId;

    /**
     * @var string
     */
    protected $_widgetNewKey = '';

    /**
     * @BeforeFeature
     */
    public static function setup()
    {
        self::_buildAdminUserFixture();
        self::_buildCategoryFixture();
        self::_buildProductFixture();
    }

    public function __construct(
        AdminLoginPage $adminLoginPage,
        AdminCmsWidgetCreationPage $adminCmsWidgetCreationPage,
        AdminCmsWidgetIndexPage $adminCmsWidgetIndexPage
    )
    {
        $this->_adminLoginPage = $adminLoginPage;
        $this->_adminCmsWidgetCreationPage = $adminCmsWidgetCreationPage;
        $this->_adminCmsWidgetIndexPage = $adminCmsWidgetIndexPage;
    }

    /**
     * @Given I am logged in as an administrator
     */
    public function iAmLoggedInAsAnAdministrator()
    {
        $admin = new AdminDataProvider();
        $adminUsername = \Mage::getModel('admin/user')->load(self::$_adminUserFixtureId)->getUsername();
        $this->_adminLoginPage->login($adminUsername, $admin->getPassword());
    }

    /**
     * @Given I visit the new widget instance addition page
     */
    public function iVisitTheNewWidgetInstanceAdditionPage()
    {
        $widgetIndexKey = $this->_adminLoginPage->getSessionKeyForUrl('admin/widget_instance/index');
        $this->_adminCmsWidgetIndexPage->indexAction($widgetIndexKey);

        $this->_widgetNewKey = $this->_adminCmsWidgetIndexPage->getSessionKeyForUrl('admin/widget_instance/new');
        $this->_adminCmsWidgetCreationPage->newAction($this->_widgetNewKey);
    }

    /**
     * @When I click the widget Type drop-down
     */
    public function iClickTheWidgetTypeDropDown()
    {
        $this->_adminCmsWidgetCreationPage->clickDropdown();
    }

    /**
     * @Then I should see the Exclusive Products widget option
     */
    public function iShouldSeeTheExclusiveProductsWidgetOption()
    {
       $exists = $this->_adminCmsWidgetCreationPage->exclusiveProductsWidgetOptionExists();

       if (!$exists) {
           throw new Exception('Exclusive Products widget type does not exist');
       }
    }

    /**
     * @throws Exception
     */
    protected static function _buildAdminUserFixture()
    {
        self::$_adminUserFixtureId = FixtureBuilder::build(
            FixtureBuilder::ADMIN_FIXTURE_TYPE,
            new FixturesLocator(),
            'admin.yaml',
            '@AfterSuite'
        );

        \Mage::getModel("admin/role")
            ->setParent_id(1)
            ->setTree_level(1)
            ->setRole_type('U')
            ->setUser_id(self::$_adminUserFixtureId)
            ->save();
    }

    /**
     * @throws Exception
     */
    protected static function _buildCategoryFixture()
    {
        self::$_categoryFixtureId = FixtureBuilder::build(
            FixtureBuilder::CATEGORY_FIXTURE_TYPE,
            new FixturesLocator(),
            'category.yaml',
            '@AfterSuite'
        );
    }

    /**
     * @throws Exception
     */
    protected static function _buildProductFixture()
    {
        for ($i = 1; $i <= self::PRODUCT_COUNT; $i++) {
            self::$_productFixtureIds[] = FixtureBuilder::build(
                FixtureBuilder::SIMPLE_PRODUCT_FIXTURE_TYPE,
                new FixturesLocator(),
                'simple-product.yaml',
                '@AfterSuite'
            );
        }
    }

    /**
     * @return Mage_Catalog_Model_Product
     */
    protected function _getProductFixtureModel($productFixtureId)
    {
        return \Mage::getModel('catalog/product')->load($productFixtureId);
    }
}
