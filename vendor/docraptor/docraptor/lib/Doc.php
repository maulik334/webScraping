<?php
/**
 * Doc
 *
 * PHP version 5
 *
 * @category Class
 * @package  DocRaptor
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * DocRaptor
 *
 * A native client library for the DocRaptor HTML to PDF/XLS service.
 *
 * OpenAPI spec version: 2.0.0
 *
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.14
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace DocRaptor;

use \ArrayAccess;
use \DocRaptor\ObjectSerializer;

/**
 * Doc Class Doc Comment
 *
 * @category Class
 * @package  DocRaptor
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Doc implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Doc';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
        'document_type' => 'string',
        'document_content' => 'string',
        'document_url' => 'string',
        'test' => 'bool',
        'pipeline' => 'string',
        'strict' => 'string',
        'ignore_resource_errors' => 'bool',
        'ignore_console_messages' => 'bool',
        'tag' => 'string',
        'help' => 'bool',
        'javascript' => 'bool',
        'referrer' => 'string',
        'callback_url' => 'string',
        'hosted_download_limit' => 'int',
        'hosted_expires_at' => 'string',
        'prince_options' => '\DocRaptor\PrinceOptions'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
        'document_type' => null,
        'document_content' => null,
        'document_url' => null,
        'test' => null,
        'pipeline' => null,
        'strict' => null,
        'ignore_resource_errors' => null,
        'ignore_console_messages' => null,
        'tag' => null,
        'help' => null,
        'javascript' => null,
        'referrer' => null,
        'callback_url' => null,
        'hosted_download_limit' => null,
        'hosted_expires_at' => null,
        'prince_options' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'name' => 'name',
        'document_type' => 'document_type',
        'document_content' => 'document_content',
        'document_url' => 'document_url',
        'test' => 'test',
        'pipeline' => 'pipeline',
        'strict' => 'strict',
        'ignore_resource_errors' => 'ignore_resource_errors',
        'ignore_console_messages' => 'ignore_console_messages',
        'tag' => 'tag',
        'help' => 'help',
        'javascript' => 'javascript',
        'referrer' => 'referrer',
        'callback_url' => 'callback_url',
        'hosted_download_limit' => 'hosted_download_limit',
        'hosted_expires_at' => 'hosted_expires_at',
        'prince_options' => 'prince_options'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'document_type' => 'setDocumentType',
        'document_content' => 'setDocumentContent',
        'document_url' => 'setDocumentUrl',
        'test' => 'setTest',
        'pipeline' => 'setPipeline',
        'strict' => 'setStrict',
        'ignore_resource_errors' => 'setIgnoreResourceErrors',
        'ignore_console_messages' => 'setIgnoreConsoleMessages',
        'tag' => 'setTag',
        'help' => 'setHelp',
        'javascript' => 'setJavascript',
        'referrer' => 'setReferrer',
        'callback_url' => 'setCallbackUrl',
        'hosted_download_limit' => 'setHostedDownloadLimit',
        'hosted_expires_at' => 'setHostedExpiresAt',
        'prince_options' => 'setPrinceOptions'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'document_type' => 'getDocumentType',
        'document_content' => 'getDocumentContent',
        'document_url' => 'getDocumentUrl',
        'test' => 'getTest',
        'pipeline' => 'getPipeline',
        'strict' => 'getStrict',
        'ignore_resource_errors' => 'getIgnoreResourceErrors',
        'ignore_console_messages' => 'getIgnoreConsoleMessages',
        'tag' => 'getTag',
        'help' => 'getHelp',
        'javascript' => 'getJavascript',
        'referrer' => 'getReferrer',
        'callback_url' => 'getCallbackUrl',
        'hosted_download_limit' => 'getHostedDownloadLimit',
        'hosted_expires_at' => 'getHostedExpiresAt',
        'prince_options' => 'getPrinceOptions'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    const DOCUMENT_TYPE_PDF = 'pdf';
    const DOCUMENT_TYPE_XLS = 'xls';
    const DOCUMENT_TYPE_XLSX = 'xlsx';
    const STRICT_NONE = 'none';
    const STRICT_HTML = 'html';



    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDocumentTypeAllowableValues()
    {
        return [
            self::DOCUMENT_TYPE_PDF,
            self::DOCUMENT_TYPE_XLS,
            self::DOCUMENT_TYPE_XLSX,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStrictAllowableValues()
    {
        return [
            self::STRICT_NONE,
            self::STRICT_HTML,
        ];
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['document_type'] = isset($data['document_type']) ? $data['document_type'] : null;
        $this->container['document_content'] = isset($data['document_content']) ? $data['document_content'] : null;
        $this->container['document_url'] = isset($data['document_url']) ? $data['document_url'] : null;
        $this->container['test'] = isset($data['test']) ? $data['test'] : true;
        $this->container['pipeline'] = isset($data['pipeline']) ? $data['pipeline'] : null;
        $this->container['strict'] = isset($data['strict']) ? $data['strict'] : null;
        $this->container['ignore_resource_errors'] = isset($data['ignore_resource_errors']) ? $data['ignore_resource_errors'] : true;
        $this->container['ignore_console_messages'] = isset($data['ignore_console_messages']) ? $data['ignore_console_messages'] : false;
        $this->container['tag'] = isset($data['tag']) ? $data['tag'] : null;
        $this->container['help'] = isset($data['help']) ? $data['help'] : false;
        $this->container['javascript'] = isset($data['javascript']) ? $data['javascript'] : false;
        $this->container['referrer'] = isset($data['referrer']) ? $data['referrer'] : null;
        $this->container['callback_url'] = isset($data['callback_url']) ? $data['callback_url'] : null;
        $this->container['hosted_download_limit'] = isset($data['hosted_download_limit']) ? $data['hosted_download_limit'] : null;
        $this->container['hosted_expires_at'] = isset($data['hosted_expires_at']) ? $data['hosted_expires_at'] : null;
        $this->container['prince_options'] = isset($data['prince_options']) ? $data['prince_options'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['document_type'] === null) {
            $invalidProperties[] = "'document_type' can't be null";
        }
        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!is_null($this->container['document_type']) && !in_array($this->container['document_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'document_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['document_content'] === null) {
            $invalidProperties[] = "'document_content' can't be null";
        }
        $allowedValues = $this->getStrictAllowableValues();
        if (!is_null($this->container['strict']) && !in_array($this->container['strict'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'strict', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name A name for identifying your document.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets document_type
     *
     * @return string
     */
    public function getDocumentType()
    {
        return $this->container['document_type'];
    }

    /**
     * Sets document_type
     *
     * @param string $document_type The type of document being created.
     *
     * @return $this
     */
    public function setDocumentType($document_type)
    {
        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!in_array($document_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'document_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['document_type'] = $document_type;

        return $this;
    }

    /**
     * Gets document_content
     *
     * @return string
     */
    public function getDocumentContent()
    {
        return $this->container['document_content'];
    }

    /**
     * Sets document_content
     *
     * @param string $document_content The HTML data to be transformed into a document. You must supply content using document_content or document_url.
     *
     * @return $this
     */
    public function setDocumentContent($document_content)
    {
        $this->container['document_content'] = $document_content;

        return $this;
    }

    /**
     * Gets document_url
     *
     * @return string
     */
    public function getDocumentUrl()
    {
        return $this->container['document_url'];
    }

    /**
     * Sets document_url
     *
     * @param string $document_url The URL to fetch the HTML data to be transformed into a document. You must supply content using document_content or document_url.
     *
     * @return $this
     */
    public function setDocumentUrl($document_url)
    {
        $this->container['document_url'] = $document_url;

        return $this;
    }

    /**
     * Gets test
     *
     * @return bool
     */
    public function getTest()
    {
        return $this->container['test'];
    }

    /**
     * Sets test
     *
     * @param bool $test Enable test mode for this document. Test documents are not charged for but include a watermark.
     *
     * @return $this
     */
    public function setTest($test)
    {
        $this->container['test'] = $test;

        return $this;
    }

    /**
     * Gets pipeline
     *
     * @return string
     */
    public function getPipeline()
    {
        return $this->container['pipeline'];
    }

    /**
     * Sets pipeline
     *
     * @param string $pipeline Specify a specific verison of the DocRaptor Pipeline to use.
     *
     * @return $this
     */
    public function setPipeline($pipeline)
    {
        $this->container['pipeline'] = $pipeline;

        return $this;
    }

    /**
     * Gets strict
     *
     * @return string
     */
    public function getStrict()
    {
        return $this->container['strict'];
    }

    /**
     * Sets strict
     *
     * @param string $strict Force strict HTML validation.
     *
     * @return $this
     */
    public function setStrict($strict)
    {
        $allowedValues = $this->getStrictAllowableValues();
        if (!is_null($strict) && !in_array($strict, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'strict', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['strict'] = $strict;

        return $this;
    }

    /**
     * Gets ignore_resource_errors
     *
     * @return bool
     */
    public function getIgnoreResourceErrors()
    {
        return $this->container['ignore_resource_errors'];
    }

    /**
     * Sets ignore_resource_errors
     *
     * @param bool $ignore_resource_errors Failed loading of images/javascripts/stylesheets/etc. will not cause the rendering to stop.
     *
     * @return $this
     */
    public function setIgnoreResourceErrors($ignore_resource_errors)
    {
        $this->container['ignore_resource_errors'] = $ignore_resource_errors;

        return $this;
    }

    /**
     * Gets ignore_console_messages
     *
     * @return bool
     */
    public function getIgnoreConsoleMessages()
    {
        return $this->container['ignore_console_messages'];
    }

    /**
     * Sets ignore_console_messages
     *
     * @param bool $ignore_console_messages Prevent console.log from stopping document rendering during JavaScript execution.
     *
     * @return $this
     */
    public function setIgnoreConsoleMessages($ignore_console_messages)
    {
        $this->container['ignore_console_messages'] = $ignore_console_messages;

        return $this;
    }

    /**
     * Gets tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->container['tag'];
    }

    /**
     * Sets tag
     *
     * @param string $tag A field for storing a small amount of metadata with this document.
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->container['tag'] = $tag;

        return $this;
    }

    /**
     * Gets help
     *
     * @return bool
     */
    public function getHelp()
    {
        return $this->container['help'];
    }

    /**
     * Sets help
     *
     * @param bool $help Request support help with this request if it succeeds.
     *
     * @return $this
     */
    public function setHelp($help)
    {
        $this->container['help'] = $help;

        return $this;
    }

    /**
     * Gets javascript
     *
     * @return bool
     */
    public function getJavascript()
    {
        return $this->container['javascript'];
    }

    /**
     * Sets javascript
     *
     * @param bool $javascript Enable DocRaptor JavaScript parsing. PrinceXML JavaScript parsing is also available elsewhere.
     *
     * @return $this
     */
    public function setJavascript($javascript)
    {
        $this->container['javascript'] = $javascript;

        return $this;
    }

    /**
     * Gets referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->container['referrer'];
    }

    /**
     * Sets referrer
     *
     * @param string $referrer Set HTTP referrer when generating this document.
     *
     * @return $this
     */
    public function setReferrer($referrer)
    {
        $this->container['referrer'] = $referrer;

        return $this;
    }

    /**
     * Gets callback_url
     *
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->container['callback_url'];
    }

    /**
     * Sets callback_url
     *
     * @param string $callback_url A URL that will receive a POST request after successfully completing an asynchronous document. The POST data will include download_url and download_id similar to status API responses. WARNING: this only works on asynchronous documents.
     *
     * @return $this
     */
    public function setCallbackUrl($callback_url)
    {
        $this->container['callback_url'] = $callback_url;

        return $this;
    }

    /**
     * Gets hosted_download_limit
     *
     * @return int
     */
    public function getHostedDownloadLimit()
    {
        return $this->container['hosted_download_limit'];
    }

    /**
     * Sets hosted_download_limit
     *
     * @param int $hosted_download_limit The number of times a hosted document can be downloaded.  If no limit is specified, the document will be available for an unlimited number of downloads.
     *
     * @return $this
     */
    public function setHostedDownloadLimit($hosted_download_limit)
    {
        $this->container['hosted_download_limit'] = $hosted_download_limit;

        return $this;
    }

    /**
     * Gets hosted_expires_at
     *
     * @return string
     */
    public function getHostedExpiresAt()
    {
        return $this->container['hosted_expires_at'];
    }

    /**
     * Sets hosted_expires_at
     *
     * @param string $hosted_expires_at The date and time at which a hosted document will be removed and no longer available. Must be a properly formatted ISO 8601 datetime, like 1981-01-23T08:02:30-05:00.
     *
     * @return $this
     */
    public function setHostedExpiresAt($hosted_expires_at)
    {
        $this->container['hosted_expires_at'] = $hosted_expires_at;

        return $this;
    }

    /**
     * Gets prince_options
     *
     * @return \DocRaptor\PrinceOptions
     */
    public function getPrinceOptions()
    {
        return $this->container['prince_options'];
    }

    /**
     * Sets prince_options
     *
     * @param \DocRaptor\PrinceOptions $prince_options prince_options
     *
     * @return $this
     */
    public function setPrinceOptions($prince_options)
    {
        $this->container['prince_options'] = $prince_options;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

